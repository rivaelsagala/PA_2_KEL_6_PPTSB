<?php

namespace App\Http\Controllers;

use App\Models\Pusat;
use App\Models\Cabang;
use App\Models\Sektor;
use App\Models\Status;
use App\Models\Anggota;
use App\Models\Regional;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\DetailPindah;
use Illuminate\Http\Request;
use App\Models\HeadRegPindah;
use App\Models\HubunganKeluarga;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DetRegistrasiAnggota;

class KeluargaController extends Controller
{

    public function keluarga_dashboard()
    {
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

        $sektor = Sektor::all();
        $cabang = Cabang::all();
        $totalData1 = $anggota->count();
        $totalData2 = $sektor->count();
        $totalData3 = $cabang->count();

        $regional = Regional::all();
        $totalregional = $regional->count();

        $pusat = Pusat::all();
        $totalpusat = $pusat->count();

        $cabang = Cabang::all();
        $totalcabang = $cabang->count();

        $sektor = Sektor::all();
        $totalsektor = $sektor->count();

        return view('keluarga/index', compact('totalData1', 'totalData2', 'totalData3', 'totalregional', 'totalpusat', 'totalcabang', 'totalsektor',));
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

        return view('/keluarga/keluarga/detail', compact('pekerjaans', 'statuses', 'pekerjaans', 'pendidikans', 'kepala_keluarga', 'anggota', 'data', 'sektors', 'registrasi_id'));
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
            return redirect('/admin-anggota')->with('toast_error', 'Foto tidak ditemukan');
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
            return redirect('/admin-anggota')->with('toast_success', 'Data berhasil ditambah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/admin-anggota')->with('toast_error', 'Gagal menambah data: ' . $e->getMessage());
        }
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

            return redirect()->back()->with('success', 'Request berhasil Dilakukan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.' . $e->getMessage());
        }
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
            // 'sektor' => 'required|exists:sektor,id_sektor',
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
            // $sektor = Sektor::where('kode_sektor', auth()->user()->kode)->first();
            $keluarga = Anggota::join('hubungan_keluarga', 'anggota.id_hubungan_keluarga', '=', 'hubungan_keluarga.id_hubungan_keluarga')
                ->leftJoin('det_registrasi_anggota', 'anggota.id_anggota', '=', 'det_registrasi_anggota.id_anggota')
                ->leftJoin('registrasi_anggota', 'det_registrasi_anggota.id_registrasi', '=', 'registrasi_anggota.id_registrasi')
                ->where('hubungan_keluarga.keterangan', 'Kepala Keluarga')
                ->where('registrasi_anggota.no_registrasi', auth()->user()->kode)
                ->first();
            if ($keluarga) {
                return redirect()->route('keluarga_kepala_keluarga.detail', ['id' => $keluarga->id_anggota])->with('toast_success', 'Data Anggota berhasil diperbarui');
            } else {
                return redirect()->route('error.page')->with('toast_error', 'Anggota tidak ditemukan.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $keluarga = Anggota::join('hubungan_keluarga', 'anggota.id_hubungan_keluarga', '=', 'hubungan_keluarga.id_hubungan_keluarga')
                ->leftJoin('det_registrasi_anggota', 'anggota.id_anggota', '=', 'det_registrasi_anggota.id_anggota')
                ->leftJoin('registrasi_anggota', 'det_registrasi_anggota.id_registrasi', '=', 'registrasi_anggota.id_registrasi')
                ->where('hubungan_keluarga.keterangan', 'Kepala Keluarga')
                ->where('registrasi_anggota.no_registrasi', auth()->user()->kode)
                ->first();
            if ($keluarga) {
                return redirect()->route('keluarga_kepala_keluarga.detail', ['id' => $keluarga->id_anggota])->with('toast_error', 'Gagal memperbarui data: ' . $e->getMessage());
            } else {
                return redirect()->route('error.page')->with('toast_error', 'Anggota tidak ditemukan.');
            }
        }
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

        return view('/keluarga/anggota/edit', compact('anggota', 'statuses', 'pekerjaans', 'pendidikans', 'hubunganKeluargas', 'sektors'));
    }
}
