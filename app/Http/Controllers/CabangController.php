<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Pusat;
use App\Models\Bidang;
use App\Models\Cabang;
use App\Models\Sektor;
use App\Models\Status;
use App\Models\Anggota;
use App\Models\Jabatan;
use App\Models\Kegiatan;
use App\Models\Regional;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\DetailPindah;
use Illuminate\Http\Request;
use App\Models\DetAksiSosial;
use App\Models\HeadRegPindah;
use App\Models\HeadAksiSosial;
use App\Models\HubunganKeluarga;
use App\Models\PejabatStruktural;
use App\Models\RegistrasiAnggota;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DetRegistrasiAnggota;

class CabangController extends Controller
{

    // PENGUMUMAN

    public function pengumuman()
    {
        $kegiatan = Kegiatan::select('kegiatan.nama_kegiatan', 'kegiatan.id_kegiatan', 'kegiatan.gambar', 'kegiatan.tempat', 'kegiatan.tanggal', 'kegiatan.waktu', 'head_aksi_sosial.nama_aksi_sosial', 'det_aksi_sosial.jumlah_bantuan', 'det_aksi_sosial.keterangan', 'anggota.nama_depan')
            ->join('head_aksi_sosial', 'kegiatan.id_kegiatan', '=', 'head_aksi_sosial.id_kegiatan')
            ->join('det_aksi_sosial', 'head_aksi_sosial.id_head_aksi', '=', 'det_aksi_sosial.id_head_aksi')
            ->join('anggota', 'det_aksi_sosial.id_anggota', '=', 'anggota.id_anggota')
            ->get();

        $anggota = Anggota::all();

        $totalData = $kegiatan->count();

        return view('/cabang/pengumuman/index', compact('anggota', 'kegiatan', 'totalData'));
    }

    public function tambah_pengumuman(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required',
            'gambar' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tanggal' => 'required',
            'waktu' => 'required',
            'tempat' => 'required',
            'nama_aksi_sosial' => 'required',
            'jumlah_bantuan' => 'required|integer',
            'keterangan' => 'required',
            'id_anggota' => 'required|exists:anggota,id_anggota'
        ]);


        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_file = $file->getClientOriginalName();
            $tujuan_upload = 'assets/gambar';
            $file->move($tujuan_upload, $nama_file);

            $data = new Kegiatan();
            $data->nama_kegiatan = $request->nama_kegiatan;
            $data->gambar = $nama_file;
            $data->tanggal = $request->tanggal;
            $data->waktu = $request->waktu;
            $data->tempat = $request->tempat;
            $data->save();

            $headAksiSosial = new HeadAksiSosial();
            $headAksiSosial->id_kegiatan = $data->id_kegiatan;
            $headAksiSosial->nama_aksi_sosial = $request->nama_aksi_sosial;
            $headAksiSosial->save();

            $detAksiSosial = new DetAksiSosial();
            $detAksiSosial->id_head_aksi = $headAksiSosial->id_head_aksi;
            $detAksiSosial->jumlah_bantuan = $request->jumlah_bantuan;
            $detAksiSosial->keterangan = $request->keterangan;
            $detAksiSosial->id_anggota = $request->id_anggota;
            $detAksiSosial->save();

            return redirect('/cabang-pengumuman')->with('toast_success', 'Data berhasil ditambah');
        } else {
            return redirect('/cabang-pengumuman')->with('toast_error', 'Foto tidak ditemukan');
        }
    }

    public function edit_pengumuman_halaman($id)
    {
        $kegiatan = Kegiatan::select('kegiatan.nama_kegiatan', 'kegiatan.gambar', 'kegiatan.id_kegiatan', 'kegiatan.tempat', 'kegiatan.tanggal', 'kegiatan.waktu', 'head_aksi_sosial.nama_aksi_sosial', 'det_aksi_sosial.jumlah_bantuan', 'det_aksi_sosial.keterangan', 'anggota.nama_depan', 'det_aksi_sosial.id_anggota')
            ->join('head_aksi_sosial', 'kegiatan.id_kegiatan', '=', 'head_aksi_sosial.id_kegiatan')
            ->join('det_aksi_sosial', 'head_aksi_sosial.id_head_aksi', '=', 'det_aksi_sosial.id_head_aksi')
            ->join('anggota', 'det_aksi_sosial.id_anggota', '=', 'anggota.id_anggota')
            ->where('kegiatan.id_kegiatan', $id)
            ->firstOrFail();

        $anggota = Anggota::all();
        return view('cabang/pengumuman/edit', compact('kegiatan', 'anggota'));
    }

    public function edit_pengumuman(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tanggal' => 'required',
            'waktu' => 'required',
            'tempat' => 'required',
            'nama_aksi_sosial' => 'required',
            'jumlah_bantuan' => 'required|integer',
            'keterangan' => 'required',
            'id_anggota' => 'required|exists:anggota,id_anggota'
        ]);

        $kegiatan = Kegiatan::findOrFail($id);

        if ($request->hasFile('gambar')) {
            // Menghapus gambar lama jika ada
            if (file_exists(public_path('assets/gambar/' . $kegiatan->gambar))) {
                unlink(public_path('assets/gambar/' . $kegiatan->gambar));
            }

            $file = $request->file('gambar');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $tujuan_upload = 'assets/gambar';
            $file->move($tujuan_upload, $nama_file);
            $kegiatan->gambar = $nama_file;
        }

        DB::beginTransaction();

        try {
            $kegiatan->update([
                'nama_kegiatan' => $validated['nama_kegiatan'],
                'tanggal' => $validated['tanggal'],
                'waktu' => $validated['waktu'],
                'tempat' => $validated['tempat'],
            ]);

            $headAksiSosial = HeadAksiSosial::where('id_kegiatan', $kegiatan->id_kegiatan)->first();
            $headAksiSosial->update([
                'nama_aksi_sosial' => $validated['nama_aksi_sosial'],
            ]);

            $detAksiSosial = DetAksiSosial::where('id_head_aksi', $headAksiSosial->id_head_aksi)->first();
            $detAksiSosial->update([
                'jumlah_bantuan' => $validated['jumlah_bantuan'],
                'keterangan' => $validated['keterangan'],
                'id_anggota' => $validated['id_anggota'],
            ]);

            DB::commit();
            return redirect('/cabang-pengumuman')->with('toast_success', 'Data pengumuman berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/cabang-pengumuman')->with('toast_error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function delete_pengumuman($id)
    {
        $delete = Kegiatan::where('id_kegiatan', $id)->delete();
        if ($delete) {
            return redirect('/cabang-pengumuman');
        } else {
            return redirect('/cabang-pengumuman')->with(['error' => "Gagal Di Hapus!"]);
        }
    }


    // ------------------------------------------ CABANG -------------------------------------------


    public function cabang_dashboard()
    {
        $regional = Regional::all();
        $totalregional = $regional->count();

        $pusat = Pusat::all();
        $totalpusat = $pusat->count();

        $cabang = Cabang::all();
        $totalcabang = $cabang->count();

        $sektor = Sektor::all();
        $totalsektor = $sektor->count();



        return view('cabang/index', compact('totalregional', 'totalpusat', 'totalcabang', 'totalsektor',));
    }


    public function cabang()
    {
        $data = Cabang::join('regional', 'cabang.id_regional', '=', 'regional.id_regional')
            ->select(
                'cabang.*',
                'regional.nama_regional AS nama_regional',
            )->get();
        $regional = Regional::all();
        $totalData = $data->count();
        return view('cabang/cabang/index', compact('data', 'totalData', 'regional'));
    }


    public function edit_cabang_show($id)
    {
        $cabang = Cabang::where('id_cabang', $id)->first();
        return view('cabang.cabang.edit', compact('cabang'));
    }


    public function edit_cabang(Request $request, $id)
    {
        // dd($request);
        $cabang = cabang::where('id_cabang', $id)->first(); // Correct column
        if ($cabang) {
            $cabang->nama_cabang = $request->input('nama_cabang');
            $cabang->alamat = $request->input('alamat');
            $cabang->nama_kepala_cabang = $request->input('nama_kepala_cabang');
            // dd($regional);
            $cabang->save();
            return redirect('/cabang-cabang')->with('toast_success', 'Data berhasil diedit');
        } else {
            return redirect('/cabang-cabang')->with('toast_error', 'Data tidak ditemukan');
        }
    }

    // ---------------------------------- KEPALA KELUARGA -----------------------------------


    public function kepala_keluarga()
    {
        // Mengambil data anggota yang tergabung dalam sektor tertentu
        $anggota = Anggota::join('hubungan_keluarga', 'anggota.id_hubungan_keluarga', '=', 'hubungan_keluarga.id_hubungan_keluarga')
            ->join('pekerjaan', 'anggota.id_pekerjaan', '=', 'pekerjaan.id_pekerjaan')
            ->join('pendidikan', 'anggota.id_pendidikan', '=', 'pendidikan.id_pendidikan')
            ->join('status', 'anggota.id_status', '=', 'status.id_status')
            ->leftJoin('det_registrasi_anggota', 'anggota.id_anggota', '=', 'det_registrasi_anggota.id_anggota')
            ->leftJoin('registrasi_anggota', 'det_registrasi_anggota.id_registrasi', '=', 'registrasi_anggota.id_registrasi')
            ->leftJoin('sektor', 'registrasi_anggota.id_sektor', '=', 'sektor.id_sektor')
            ->where('anggota.id_hubungan_keluarga', 1)
            ->select(
                'anggota.*',
                'pekerjaan.nama_pekerjaan AS nama_pekerjaan',
                'pendidikan.tingkat_pendidikan AS tingkat_pendidikan',
                'hubungan_keluarga.keterangan AS hubungan_keluarga',
                'status.keterangan AS status',
                'registrasi_anggota.no_registrasi AS no_registrasi',
                'sektor.nama_sektor AS nama_sektor'
            )
            ->get();

        $pekerjaans = Pekerjaan::all();
        $pendidikans = Pendidikan::all();
        $sektors = Sektor::all();
        $statuses = Status::all()->where('id_jenis_status', 1);

        // Mengambil data untuk dropdown di form
        $totalData = $anggota->count();

        return view('/cabang/kepala_keluarga/index', compact('totalData', 'anggota', 'pekerjaans', 'pendidikans', 'sektors', 'statuses'));
    }

    public function tambah_kepala_keluarga(Request $request)
    {
        $validated = $request->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'gelar_depan' => 'sometimes',
            'gelar_belakang' => 'sometimes',
            'tempat_lahir' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|exists:status,id_status',
            'pekerjaan' => 'required|exists:pekerjaan,id_pekerjaan',
            'pendidikan' => 'required|exists:pendidikan,id_pendidikan',
            'sektor' => 'required|exists:sektor,id_sektor',
            'no_registrasi' => 'required|unique:registrasi_anggota,no_registrasi',
            'keterangan' => 'required',
        ], [
            'no_registrasi.unique' => 'Nomor registrasi sudah digunakan. Silakan masukkan nomor registrasi yang berbeda.',
            'required' => ':attribute harus diisi.',
            'exists' => ':attribute tidak valid.',
            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Format foto harus jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        // Check if id_status 4 exists in the status table
        $defaultStatus = DB::table('status')->where('id_status', 4)->first();
        if (!$defaultStatus) {
            return redirect()->back()->with('toast_error', 'Status default tidak ditemukan');
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $tujuan_upload = 'assets/gambar';
            $file->move($tujuan_upload, $nama_file);
        } else {
            return redirect('/cabang-anggota')->with('toast_error', 'Foto tidak ditemukan');
        }

        DB::beginTransaction();

        try {
            $anggota = Anggota::create([
                'nama_depan' => $validated['nama_depan'],
                'nama_belakang' => $validated['nama_belakang'],
                'gelar_depan' => $validated['gelar_depan'],
                'gelar_belakang' => $validated['gelar_belakang'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'no_telepon' => $validated['no_telepon'],
                'alamat' => $validated['alamat'],
                'foto' => $nama_file,
                'id_status' => $validated['status'],
                'id_hubungan_keluarga' => 1,
                'id_pekerjaan' => $validated['pekerjaan'],
                'id_pendidikan' => $validated['pendidikan'],
                'keterangan' => $validated['keterangan'],
            ]);

            $registrasi = RegistrasiAnggota::create([
                'id_sektor' => $validated['sektor'],
                'no_registrasi' => $validated['no_registrasi'],
                'tgl_registrasi' => Carbon::now(),
            ]);

            DetRegistrasiAnggota::create([
                'id_registrasi' => $registrasi->id_registrasi,
                'id_anggota' => $anggota->id_anggota,
                'id_status' => 4, // Default value for id_status in det_registrasi_anggota
            ]);

            User::create([
                'username' => $anggota->nama_depan,
                'password' => bcrypt($validated['no_registrasi']),
                'kode' => $registrasi->no_registrasi,
                'role' => 'Kepala Keluarga',
            ]);

            DB::commit();
            return redirect('/cabang-kepala_keluarga')->with('toast_success', 'Data berhasil ditambah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/cabang-kepala_keluarga')->with('toast_error', 'Gagal menambah data: ' . $e->getMessage());
        }
    }


    public function edit_kepala_keluarga_show($id)
    {
        // Mengambil data anggota berdasarkan id_anggota

        $anggota = Anggota::join('hubungan_keluarga', 'anggota.id_hubungan_keluarga', '=', 'hubungan_keluarga.id_hubungan_keluarga')
            ->join('pekerjaan', 'anggota.id_pekerjaan', '=', 'pekerjaan.id_pekerjaan')
            ->join('pendidikan', 'anggota.id_pendidikan', '=', 'pendidikan.id_pendidikan')
            ->join('status', 'anggota.id_status', '=', 'status.id_status')
            ->leftJoin('det_registrasi_anggota', 'anggota.id_anggota', '=', 'det_registrasi_anggota.id_anggota')
            ->select(
                'anggota.*',
                'pekerjaan.nama_pekerjaan AS nama_pekerjaan',
                'pendidikan.tingkat_pendidikan AS tingkat_pendidikan',
                'hubungan_keluarga.keterangan AS hubungan_keluarga',
                'status.keterangan AS status',
            )
            ->where('anggota.id_anggota', $id)
            ->firstOrFail();

        // Mengambil data untuk dropdown di form
        $statuses = Status::all()->where('id_jenis_status', 1);
        $pekerjaans = Pekerjaan::all();
        $pendidikans = Pendidikan::all();
        $hubunganKeluargas = HubunganKeluarga::all();

        return view('/cabang/kepala_keluarga/edit', compact('anggota', 'statuses', 'pekerjaans', 'pendidikans', 'hubunganKeluargas'));
    }

    public function edit_kepala_keluarga(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'gelar_depan' => 'sometimes',
            'gelar_belakang' => 'sometimes',
            'tempat_lahir' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // tidak wajib, hanya jika ingin mengganti foto
            'status' => 'required|exists:status,id_status',
            'pekerjaan' => 'required|exists:pekerjaan,id_pekerjaan',
            'pendidikan' => 'required|exists:pendidikan,id_pendidikan',
            'hubungan_keluarga' => 'required|exists:hubungan_keluarga,id_hubungan_keluarga',
            'keterangan' => 'required',
        ]);

        $anggota = Anggota::findOrFail($id);

        if ($request->hasFile('foto')) {
            // Menghapus foto lama jika ada
            if (file_exists(public_path('assets/gambar/' . $anggota->foto))) {
                unlink(public_path('assets/gambar/' . $anggota->foto));
            }

            $file = $request->file('foto');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $tujuan_upload = 'assets/gambar';
            $file->move($tujuan_upload, $nama_file);
            $anggota->foto = $nama_file;
        }

        DB::beginTransaction();

        try {
            $anggota->update([
                'nama_depan' => $validated['nama_depan'],
                'nama_belakang' => $validated['nama_belakang'],
                'gelar_depan' => $validated['gelar_depan'],
                'gelar_belakang' => $validated['gelar_belakang'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'no_telepon' => $validated['no_telepon'],
                'alamat' => $validated['alamat'],
                'id_status' => $validated['status'],
                'id_pekerjaan' => $validated['pekerjaan'],
                'id_pendidikan' => $validated['pendidikan'],
                'id_hubungan_keluarga' => $validated['hubungan_keluarga'],
                'keterangan' => $validated['keterangan'],
            ]);

            DB::commit();
            return redirect('/cabang-kepala_keluarga')->with('toast_success', 'Data kepala keluarga berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/cabang-kepala_keluarga')->with('toast_error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
    public function detail_kepala_keluarga($id)
    {
        $kepala_keluarga = Anggota::join('hubungan_keluarga', 'anggota.id_hubungan_keluarga', '=', 'hubungan_keluarga.id_hubungan_keluarga')
            ->join('pekerjaan', 'anggota.id_pekerjaan', '=', 'pekerjaan.id_pekerjaan')
            ->join('pendidikan', 'anggota.id_pendidikan', '=', 'pendidikan.id_pendidikan')
            ->join('status', 'anggota.id_status', '=', 'status.id_status')
            ->leftJoin('det_registrasi_anggota', 'anggota.id_anggota', '=', 'det_registrasi_anggota.id_anggota')
            ->select(
                'anggota.*',
                'pekerjaan.nama_pekerjaan AS nama_pekerjaan',
                'pendidikan.tingkat_pendidikan AS tingkat_pendidikan',
                'hubungan_keluarga.keterangan AS hubungan_keluarga',
                'status.keterangan AS status',
            )
            ->where('anggota.id_anggota', $id)
            ->firstOrFail();

        $registrasi_id = DetRegistrasiAnggota::where('id_anggota', $kepala_keluarga->id_anggota)->value('id_registrasi');
        $anggota = Anggota::join('hubungan_keluarga', 'anggota.id_hubungan_keluarga', '=', 'hubungan_keluarga.id_hubungan_keluarga')
            ->join('pekerjaan', 'anggota.id_pekerjaan', '=', 'pekerjaan.id_pekerjaan')
            ->join('pendidikan', 'anggota.id_pendidikan', '=', 'pendidikan.id_pendidikan')
            ->join('status', 'anggota.id_status', '=', 'status.id_status')
            ->leftJoin('det_registrasi_anggota', 'anggota.id_anggota', '=', 'det_registrasi_anggota.id_anggota')
            ->leftJoin('registrasi_anggota', 'det_registrasi_anggota.id_registrasi', '=', 'registrasi_anggota.id_registrasi')
            ->leftJoin('sektor', 'registrasi_anggota.id_sektor', '=', 'sektor.id_sektor')
            ->where('anggota.id_hubungan_keluarga', 3)
            ->where('registrasi_anggota.id_registrasi', $registrasi_id)
            ->select(
                'anggota.*',
                'pekerjaan.nama_pekerjaan AS nama_pekerjaan',
                'pendidikan.tingkat_pendidikan AS tingkat_pendidikan',
                'hubungan_keluarga.keterangan AS hubungan_keluarga',
                'status.keterangan AS status',
                'sektor.nama_sektor AS nama_sektor'
            )
            ->get();

        $data = HeadRegPindah::select(
            'head_reg_pindah.no_reg_pindah AS no_reg_pindah',
            'head_reg_pindah.tgl_pindah AS tgl_pindah',
            'head_reg_pindah.file_surat_pindah AS file_surat_pindah',
            'sektor.nama_sektor AS nama_sektor'
        )
            ->join('detail_pindah', 'head_reg_pindah.id_reg_pindah', '=', 'detail_pindah.id_reg_pindah')
            ->join('anggota', 'detail_pindah.id_anggota', '=', 'anggota.id_anggota')
            ->join('registrasi_anggota', 'head_reg_pindah.id_registrasi', '=', 'registrasi_anggota.id_registrasi')
            ->join('sektor', function ($join) {
                $join->on('registrasi_anggota.id_sektor', '=', 'sektor.id_sektor')
                    ->on('head_reg_pindah.id_sektor_tujuan', '=', 'sektor.id_sektor');
            })
            ->where('anggota.id_hubungan_keluarga', 1)
            ->get();

        $statuses = Status::join('jenis_status', 'status.id_jenis_status', '=', 'jenis_status.id_jenis_status')
            ->select('status.*')
            ->where('jenis_status.keterangan', 'keaktifan')
            ->get();
        $pekerjaans = Pekerjaan::all();
        $pendidikans = Pendidikan::all();
        $sektors = Sektor::all();
        // $sektors = Sektor::all();

        return view('/cabang/kepala_keluarga/detail', compact('pekerjaans', 'statuses', 'pekerjaans', 'pendidikans', 'kepala_keluarga', 'anggota', 'data', 'sektors', 'registrasi_id'));
    }

    public function pindah_sektor(Request $request)
    {
        $validated = $request->validate([
            'no_reg_pindah' => 'required',
            'tgl_pindah' => 'required',
            'file_surat_pindah' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sektor_tujuan' => 'required|exists:sektor,id_sektor',
        ]);

        if ($request->hasFile('file_surat_pindah')) {
            $file = $request->file('file_surat_pindah');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $tujuan_upload = 'assets/gambar';
            $file->move($tujuan_upload, $nama_file);
        } else {
            return redirect()->back()->with('toast_error', 'Foto tidak ditemukan');
        }

        DB::beginTransaction();

        try {
            $pindah_sektor = HeadRegPindah::create([
                'no_reg_pindah' => $validated['no_reg_pindah'],
                'tgl_pindah' => $validated['tgl_pindah'],
                'file_surat_pindah' => $nama_file,
                'id_status' => 5,
                'id_registrasi' => $request->input('id_registrasi'),
                'id_sektor_tujuan' => $validated['sektor_tujuan'],
            ]);

            DetailPindah::create([
                'id_anggota' => $request->input('id_anggota'),
                'id_reg_pindah' => $pindah_sektor->id_reg_pindah,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }






    // --------------------------- ANGGOTA ---------------------------


    public function anggota()
    {
        $registrasiAnggota = Anggota::join('det_registrasi_anggota', 'anggota.id_anggota', '=', 'det_registrasi_anggota.id_anggota')
            ->join('registrasi_anggota', 'det_registrasi_anggota.id_registrasi', '=', 'registrasi_anggota.id_registrasi')
            ->where('anggota.id_hubungan_keluarga', 1)
            ->select('registrasi_anggota.id_registrasi', 'anggota.nama_depan')
            ->get();

        $anggota = Anggota::join('hubungan_keluarga', 'anggota.id_hubungan_keluarga', '=', 'hubungan_keluarga.id_hubungan_keluarga')
            ->join('pekerjaan', 'anggota.id_pekerjaan', '=', 'pekerjaan.id_pekerjaan')
            ->join('pendidikan', 'anggota.id_pendidikan', '=', 'pendidikan.id_pendidikan')
            ->join('status', 'anggota.id_status', '=', 'status.id_status')
            ->leftJoin('det_registrasi_anggota', 'anggota.id_anggota', '=', 'det_registrasi_anggota.id_anggota')
            ->leftJoin('registrasi_anggota', 'det_registrasi_anggota.id_registrasi', '=', 'registrasi_anggota.id_registrasi')
            ->leftJoin('det_registrasi_anggota as d1', 'registrasi_anggota.id_registrasi', '=', 'd1.id_registrasi')
            ->leftJoin('anggota as a1', function ($join) {
                $join->on('d1.id_anggota', '=', 'a1.id_anggota')
                    ->where('a1.id_hubungan_keluarga', '=', 1);
            })
            ->where('anggota.id_hubungan_keluarga', 3)
            ->whereNotNull('a1.nama_depan') // Ensure we only get rows with a kepala keluarga
            ->select(
                'anggota.*',
                'status.keterangan AS status',
                'a1.nama_depan as kepala_keluarga',
                'pekerjaan.nama_pekerjaan AS nama_pekerjaan',
                'pendidikan.tingkat_pendidikan AS tingkat_pendidikan',
                'anggota.keterangan'
            )
            ->get();

        // Mengambil data untuk dropdown di form
        $statuses = Status::all()->where('id_jenis_status', 1);
        $pekerjaans = Pekerjaan::all();
        $pendidikans = Pendidikan::all();
        $hubunganKeluargas = HubunganKeluarga::all();
        $sektors = Sektor::all();
        $regAnggota = RegistrasiAnggota::all();
        $totalData = $anggota->count();

        return view('/cabang/anggota/index', compact('totalData', 'anggota', 'statuses', 'pekerjaans', 'pendidikans', 'hubunganKeluargas', 'sektors', 'regAnggota', 'registrasiAnggota'));
    }





    public function tambah_anggota(Request $request)
    {
        $validated = $request->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'gelar_depan' => 'sometimes',
            'gelar_belakang' => 'sometimes',
            'tempat_lahir' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|exists:status,id_status',
            'pekerjaan' => 'required|exists:pekerjaan,id_pekerjaan',
            'pendidikan' => 'required|exists:pendidikan,id_pendidikan',
            'sektor' => 'required|exists:sektor,id_sektor',
            'id_registrasi' => 'required|exists:registrasi_anggota,id_registrasi',
            'keterangan' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $tujuan_upload = 'assets/gambar';
            $file->move($tujuan_upload, $nama_file);
        } else {
            return redirect('/cabang-anggota')->with('toast_error', 'Foto tidak ditemukan');
        }

        DB::beginTransaction();

        try {
            $anggota = Anggota::create([
                'nama_depan' => $validated['nama_depan'],
                'nama_belakang' => $validated['nama_belakang'],
                'gelar_depan' => $validated['gelar_depan'],
                'gelar_belakang' => $validated['gelar_belakang'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'no_telepon' => $validated['no_telepon'],
                'alamat' => $validated['alamat'],
                'foto' => $nama_file,
                'id_status' => $validated['status'],
                'id_hubungan_keluarga' => 3,
                'id_pekerjaan' => $validated['pekerjaan'],
                'id_pendidikan' => $validated['pendidikan'],
                'keterangan' => $validated['keterangan'],
            ]);

            DetRegistrasiAnggota::create([
                'id_registrasi' => $validated['id_registrasi'],
                'id_anggota' => $anggota->id_anggota,
                'id_status' => 4, // Default value for id_status in det_registrasi_anggota
            ]);

            DB::commit();
            return redirect('/cabang-anggota')->with('toast_success', 'Data berhasil ditambah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/cabang-anggota')->with('toast_error', 'Gagal menambah data: ' . $e->getMessage());
        }
    }
    public function keaktifan($id)
    {
        // Temukan anggota berdasarkan id_anggota
        $anggota = Anggota::findOrFail($id);

        // Toggle status id_status
        $anggota->id_status = $anggota->id_status == 1 ? 2 : 1;

        // Simpan perubahan
        $anggota->save();

        // Redirect kembali dengan pesan toast sukses
        return redirect()->back()->with('toast_success', 'Status anggota berhasil diubah.');
    }

    public function edit_anggota_show($id)
    {
        // Mengambil data anggota berdasarkan id_anggota
        $anggota = Anggota::join('hubungan_keluarga', 'anggota.id_hubungan_keluarga', '=', 'hubungan_keluarga.id_hubungan_keluarga')
            ->join('pekerjaan', 'anggota.id_pekerjaan', '=', 'pekerjaan.id_pekerjaan')
            ->join('pendidikan', 'anggota.id_pendidikan', '=', 'pendidikan.id_pendidikan')
            ->join('status', 'anggota.id_status', '=', 'status.id_status')
            ->leftJoin('det_registrasi_anggota', 'anggota.id_anggota', '=', 'det_registrasi_anggota.id_anggota')
            ->leftJoin('registrasi_anggota', 'det_registrasi_anggota.id_registrasi', '=', 'registrasi_anggota.id_registrasi')
            ->leftJoin('sektor', 'registrasi_anggota.id_sektor', '=', 'sektor.id_sektor')
            ->select(
                'anggota.*',
                'pekerjaan.nama_pekerjaan AS nama_pekerjaan',
                'pendidikan.tingkat_pendidikan AS tingkat_pendidikan',
                'hubungan_keluarga.keterangan AS hubungan_keluarga',
                'status.keterangan AS status',
                'sektor.nama_sektor AS nama_sektor',
                'sektor.id_sektor AS id_sektor' // Tambahkan id_sektor untuk set value pada dropdown
            )
            ->where('anggota.id_anggota', $id)
            ->firstOrFail();

        // Mengambil data untuk dropdown di form
        $statuses = Status::all();
        $pekerjaans = Pekerjaan::all();
        $pendidikans = Pendidikan::all();
        $hubunganKeluargas = HubunganKeluarga::all();
        $sektors = Sektor::all();

        return view('/cabang/anggota/edit', compact('anggota', 'statuses', 'pekerjaans', 'pendidikans', 'hubunganKeluargas', 'sektors'));
    }


    public function edit_anggota(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'gelar_depan' => 'sometimes',
            'gelar_belakang' => 'sometimes',
            'tempat_lahir' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // tidak wajib, hanya jika ingin mengganti foto
            'status' => 'required|exists:status,id_status',
            'pekerjaan' => 'required|exists:pekerjaan,id_pekerjaan',
            'pendidikan' => 'required|exists:pendidikan,id_pendidikan',
            'keterangan' => 'required',
        ]);

        $anggota = Anggota::findOrFail($id);

        if ($request->hasFile('foto')) {
            // Menghapus foto lama jika ada
            if (file_exists(public_path('assets/gambar/' . $anggota->foto))) {
                unlink(public_path('assets/gambar/' . $anggota->foto));
            }

            $file = $request->file('foto');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $tujuan_upload = 'assets/gambar';
            $file->move($tujuan_upload, $nama_file);
            $anggota->foto = $nama_file;
        }

        DB::beginTransaction();

        try {
            $anggota->update([
                'nama_depan' => $validated['nama_depan'],
                'nama_belakang' => $validated['nama_belakang'],
                'gelar_depan' => $validated['gelar_depan'],
                'gelar_belakang' => $validated['gelar_belakang'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'no_telepon' => $validated['no_telepon'],
                'alamat' => $validated['alamat'],
                'id_status' => $validated['status'],
                'id_pekerjaan' => $validated['pekerjaan'],
                'id_pendidikan' => $validated['pendidikan'],
                'keterangan' => $validated['keterangan'],
            ]);

            DB::commit();
            return redirect('/cabang-anggota')->with('toast_success', 'Data anggota berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/cabang-anggota')->with('toast_error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    // ----------------------- SEKTOR -----------------------


    public function sektor()
    {
        $data = Anggota::select(
            'anggota.nama_depan AS nama_depan',
            'sektor.kode_sektor AS kode_sektor',
            'sektor.alamat_sektor AS alamat_sektor',
            'sektor.nama_sektor AS nama_sektor',
            'cabang.nama_cabang AS nama_cabang',
            'sektor.id_sektor AS id_sektor',
            'sektor.tgl_berdiri AS tgl_berdiri',
            'anggota.nama_belakang AS nama_belakang'
        )
            ->join('det_registrasi_anggota', 'anggota.id_anggota', '=', 'det_registrasi_anggota.id_anggota')
            ->join('registrasi_anggota', 'det_registrasi_anggota.id_registrasi', '=', 'registrasi_anggota.id_registrasi')
            ->join('sektor', 'sektor.id_sektor', '=', 'registrasi_anggota.id_sektor')
            ->join('cabang', 'sektor.id_cabang', '=', 'cabang.id_cabang')
            ->join('pejabat_struktural', 'anggota.id_anggota', '=', 'pejabat_struktural.id_anggota')
            ->join('jabatan', 'pejabat_struktural.id_jabatan', '=', 'jabatan.id_jabatan')
            ->where('jabatan.nama_jabatan', 'Kepala Sektor')
            ->get();
        $cabang = Cabang::all();

        $anggota = Anggota::select('anggota.*')
            ->join('pejabat_struktural', 'anggota.id_anggota', '=', 'pejabat_struktural.id_anggota')
            ->join('jabatan', 'pejabat_struktural.id_jabatan', '=', 'jabatan.id_jabatan')
            ->where('jabatan.nama_jabatan', 'Kepala Sektor')
            ->get();

        $pindah_sektor = HeadRegPindah::join('sektor', 'head_reg_pindah.id_sektor_tujuan', '=', 'sektor.id_sektor')
            ->join('status', 'head_reg_pindah.id_status', '=', 'status.id_status')
            ->join('registrasi_anggota', 'head_reg_pindah.id_registrasi', '=', 'registrasi_anggota.id_registrasi')
            ->join('det_registrasi_anggota', 'registrasi_anggota.id_registrasi', '=', 'det_registrasi_anggota.id_registrasi')
            ->join('anggota', 'det_registrasi_anggota.id_anggota', '=', 'anggota.id_anggota')
            ->join('hubungan_keluarga', 'anggota.id_hubungan_keluarga', '=', 'hubungan_keluarga.id_hubungan_keluarga')
            ->where('hubungan_keluarga.keterangan', 'Kepala Keluarga')
            ->where('status.keterangan', 'Menunggu')
            ->select(
                'head_reg_pindah.id_reg_pindah AS id_reg_pindah',
                'head_reg_pindah.tgl_pindah AS tgl_pindah',
                'head_reg_pindah.file_surat_pindah AS file_pindah',
                'head_reg_pindah.no_reg_pindah AS no_pindah',
                'sektor.nama_sektor AS sektor_tujuan',
                'status.keterangan AS status',
                'anggota.nama_depan AS nama_depan',
                'anggota.nama_belakang AS nama_belakang',
            )
            ->get();
        $totalData = $data->count();
        $totalPindah = $pindah_sektor->count();
        return view('cabang/sektor/index', compact('data', 'totalData', 'cabang', 'anggota', 'pindah_sektor', 'totalPindah'));
    }

    public function tolak($id)
    {
        // Temukan anggota berdasarkan id_anggota
        $pindah_sektor = HeadRegPindah::findOrFail($id);
        // Toggle status id_status
        $pindah_sektor->id_status = 6;
        // Simpan perubahan
        $pindah_sektor->save();
        // Redirect kembali dengan pesan toast sukses
        return redirect()->back()->with('toast_error', 'Pindah Sektor Ditolak.');
    }
    public function terima($id)
    {
        // Temukan record di HeadRegPindah berdasarkan id
        $pindah_sektor = HeadRegPindah::findOrFail($id);

        // Perbarui id_status di HeadRegPindah
        $pindah_sektor->id_status = 4;

        // Temukan registrasi anggota yang terkait
        $registrasi_anggota = RegistrasiAnggota::where('id_registrasi', $pindah_sektor->id_registrasi)->firstOrFail();

        // Perbarui id_sektor di RegistrasiAnggota sesuai dengan id_sektor_tujuan di HeadRegPindah
        $registrasi_anggota->id_sektor = $pindah_sektor->id_sektor_tujuan;

        // Simpan perubahan di kedua model
        $pindah_sektor->save();
        $registrasi_anggota->save();

        // Redirect kembali dengan pesan toast sukses
        return redirect()->back()->with('toast_success', 'Pindah Sektor Diterima.');
    }







    public function edit_sektor_show($id)
    {
        $sektor = Sektor::where('id_sektor', $id)->first();
        return view('cabang.sektor.edit', compact('sektor'));
    }


    public function edit_sektor(Request $request, $id)
    {
        // dd($request);
        $sektor = Sektor::where('id_sektor', $id)->first(); // Correct column
        if ($sektor) {
            $sektor->nama_sektor = $request->input('nama_sektor');
            $sektor->alamat_sektor = $request->input('alamat_sektor');
            $sektor->save();
            return redirect('/cabang-sektor')->with('toast_success', 'Data berhasil diedit');
        } else {
            return redirect('/cabang-sektor')->with('toast_error', 'Data tidak ditemukan');
        }
    }

    public function tambah_sektor(Request $request)
    {
        $validated = $request->validate([
            'kode_sektor' => 'required',
            'nama_sektor' => 'required',
            'alamat_sektor' => 'required',
            'tgl_berdiri' => 'required',
            'cabang' => 'required|exists:cabang,id_cabang',
        ]);

        $sektor = Sektor::create([
            'kode_sektor' => $validated['kode_sektor'],
            'nama_sektor' => $validated['nama_sektor'],
            'alamat_sektor' => $validated['alamat_sektor'],
            'tgl_berdiri' => $validated['tgl_berdiri'],
            'id_cabang' => $validated['cabang'],
        ]);

        User::create([
            'username' => $sektor->nama_sektor,
            'password' => $sektor->kode_sektor,
            'role' => 'Kepala Sektor'
        ]);

        return redirect('/cabang-sektor')->with('toast_success', 'Data berhasil ditambah');
    }

    public function detail_sektor($id)
    {
        // Mengambil data anggota yang tergabung dalam sektor tertentu
        $anggota = Anggota::join('hubungan_keluarga', 'anggota.id_hubungan_keluarga', '=', 'hubungan_keluarga.id_hubungan_keluarga')
            ->join('pekerjaan', 'anggota.id_pekerjaan', '=', 'pekerjaan.id_pekerjaan')
            ->join('pendidikan', 'anggota.id_pendidikan', '=', 'pendidikan.id_pendidikan')
            ->join('status', 'anggota.id_status', '=', 'status.id_status')
            ->leftJoin('det_registrasi_anggota', 'anggota.id_anggota', '=', 'det_registrasi_anggota.id_anggota')
            ->leftJoin('registrasi_anggota', 'det_registrasi_anggota.id_registrasi', '=', 'registrasi_anggota.id_registrasi')
            ->leftJoin('sektor', 'registrasi_anggota.id_sektor', '=', 'sektor.id_sektor')
            ->where('registrasi_anggota.id_sektor', $id)
            ->where('hubungan_keluarga.keterangan', 'Kepala Keluarga')
            ->select(
                'anggota.*',
                'pekerjaan.nama_pekerjaan AS nama_pekerjaan',
                'pendidikan.tingkat_pendidikan AS tingkat_pendidikan',
                'hubungan_keluarga.keterangan AS hubungan_keluarga',
                'status.keterangan AS status',
                'registrasi_anggota.no_registrasi AS no_registrasi',
                'sektor.nama_sektor'
            )
            ->get();

        // Mengambil data untuk dropdown di form
        $sektors = Anggota::select(
            'anggota.nama_depan AS nama_depan',
            'sektor.kode_sektor AS kode_sektor',
            'sektor.alamat_sektor AS alamat_sektor',
            'sektor.nama_sektor AS nama_sektor',
            'sektor.id_sektor AS id_sektor',
            'cabang.nama_cabang AS nama_cabang',
            'sektor.id_sektor AS id_sektor',
            'sektor.tgl_berdiri AS tgl_berdiri',
            'anggota.nama_belakang AS nama_belakang'
        )
            ->join('det_registrasi_anggota', 'anggota.id_anggota', '=', 'det_registrasi_anggota.id_anggota')
            ->join('registrasi_anggota', 'det_registrasi_anggota.id_registrasi', '=', 'registrasi_anggota.id_registrasi')
            ->join('sektor', 'sektor.id_sektor', '=', 'registrasi_anggota.id_sektor')
            ->join('cabang', 'sektor.id_cabang', '=', 'cabang.id_cabang')
            ->join('pejabat_struktural', 'anggota.id_anggota', '=', 'pejabat_struktural.id_anggota')
            ->join('jabatan', 'pejabat_struktural.id_jabatan', '=', 'jabatan.id_jabatan')
            ->where('jabatan.nama_jabatan', 'Kepala Sektor')
            ->where('sektor.id_sektor', $id)
            ->get();

        $current_sektor = Sektor::find($id);
        // $sektors = Sektor::where('id_sektor', $id)->get();
        $pendidikans = Pendidikan::all();
        $pekerjaans = Pekerjaan::all();
        $sektores = Sektor::all();
        $statuses = Status::join('jenis_status', 'status.id_jenis_status', '=', 'jenis_status.id_jenis_status')
            ->select('status.*')
            ->where('jenis_status.keterangan', 'keaktifan')
            ->get();
        $totalData = $anggota->count();

        return view('/cabang/sektor/detail', compact('current_sektor', 'totalData', 'anggota', 'sektores', 'pendidikans', 'pekerjaans', 'sektors', 'statuses'));
    }

    // --------------------------- Pejabat Struktural --------------------

    public function pejabat()
    {
        $pejabat = Jabatan::select(
            'anggota.nama_depan AS nama_depan',
            'anggota.nama_belakang AS nama_belakang',
            'jabatan.nama_jabatan AS jabatan',
            'bidang.nama_bidang AS bidang',
            'pejabat_struktural.id_pejabat_struktural AS id_pejabat',
            'pejabat_struktural.tgl_SK_pengangkatan AS tgl_sk',
            'pejabat_struktural.awal_tahun_jabatan AS awal_jabatan',
            'pejabat_struktural.akhir_tahun_jabatan AS akhir_jabatan',
            'pejabat_struktural.no_SK_pengangkatan AS no_sk',
            'status.keterangan AS status'
        )
            ->join('pejabat_struktural', 'jabatan.id_jabatan', '=', 'pejabat_struktural.id_jabatan')
            ->join('anggota', 'pejabat_struktural.id_anggota', '=', 'anggota.id_anggota')
            ->join('status', 'pejabat_struktural.id_status', '=', 'status.id_status')
            ->join('bidang', 'pejabat_struktural.id_bidang', '=', 'bidang.id_bidang')
            ->orderBy('pejabat_struktural.id_pejabat_struktural')
            ->get();

        $statuses = Status::all()->where('id_jenis_status', 1);
        $jabatans = Jabatan::all();
        $bidangs = Bidang::all();
        $anggotas = Anggota::leftJoin('pejabat_struktural', 'anggota.id_anggota', '=', 'pejabat_struktural.id_anggota')
            ->whereNull('pejabat_struktural.id_anggota')
            ->select('anggota.*')
            ->get();
        $totalData = $pejabat->count();


        return view('/cabang/pejabat_struktural/index', compact('pejabat', 'totalData', 'statuses', 'bidangs', 'jabatans', 'anggotas'));
    }

    public function tambah_pejabat(Request $request)
    {
        $validated = $request->validate([
            'jabatan' => 'required|exists:jabatan,id_jabatan',
            'anggota' => 'required|exists:anggota,id_anggota',
            'tgl_SK_pengangkatan' => 'required',
            'awal_tahun_jabatan' => 'required',
            'akhir_tahun_jabatan' => 'required',
            'no_SK_pengangkatan' => 'required',
            'status' => 'required|exists:status,id_status',
            'bidang' => 'required|exists:bidang,id_bidang',
        ]);

        PejabatStruktural::create([
            'id_jabatan' => $validated['jabatan'],
            'id_anggota' => $validated['anggota'],
            'tgl_SK_pengangkatan' => $validated['tgl_SK_pengangkatan'],
            'awal_tahun_jabatan' => $validated['awal_tahun_jabatan'],
            'akhir_tahun_jabatan' => $validated['akhir_tahun_jabatan'],
            'no_SK_pengangkatan' => $validated['no_SK_pengangkatan'],
            'id_status' => $validated['status'],
            'id_bidang' => $validated['bidang'],
        ]);

        return redirect('/cabang-pejabat')->with('toast_success', 'Data berhasil ditambah');
    }

    public function edit_pejabat_show($id)
    {
        $pejabat = PejabatStruktural::where('id_pejabat_struktural', $id)->first();
        return view('cabang.pejabat_struktural.edit', compact('pejabat'));
    }


    public function edit_pejabat(Request $request, $id)
    {
        // dd($request);
        $pejabat = PejabatStruktural::where('id_pejabat_struktural', $id)->first(); // Correct column
        if ($pejabat) {
            $pejabat->awal_tahun_jabatan = $request->input('awal_tahun_jabatan');
            $pejabat->akhir_tahun_jabatan = $request->input('akhir_tahun_jabatan');
            $pejabat->no_SK_pengangkatan = $request->input('no_SK_pengangkatan');
            // dd($regional);
            $pejabat->save();
            return redirect('/cabang-pejabat')->with('toast_success', 'Data berhasil diedit');
        } else {
            return redirect('/cabang-pejabat')->with('toast_error', 'Data tidak ditemukan');
        }
    }
}
