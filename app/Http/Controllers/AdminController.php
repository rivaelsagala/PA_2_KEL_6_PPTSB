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
use App\Models\JenisStatus;
use App\Models\DetailPindah;
use Illuminate\Http\Request;
use App\Models\DetAksiSosial;
use App\Models\HeadRegPindah;
use App\Models\HeadAksiSosial;
use App\Models\HubunganKeluarga;
use App\Models\PejabatStruktural;
use App\Models\RegistrasiAnggota;
use Illuminate\Support\Facades\DB;
use App\Models\DetRegistrasiAnggota;

class AdminController extends Controller
{
    public function admin()
    {
        $regional = Regional::all();
        $totalregional = $regional->count();

        $pusat = Pusat::all();
        $totalpusat = $pusat->count();

        $cabang = Cabang::all();
        $totalcabang = $cabang->count();

        $sektor = Sektor::all();
        $totalsektor = $sektor->count();



        return view('admin/index', compact('totalregional', 'totalpusat', 'totalcabang', 'totalsektor',));
    }



    //Jenis Status
    public function jenis_status()
    {
        $data = JenisStatus::all();
        $totalData = $data->count();
        $anggota = Anggota::all();
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('admin/jenis_status/index', compact('data', 'totalData', 'anggota'));
    }
    public function tambah_jenis_status(Request $request)
    {
        $validated = $request->validate([
            'keterangan' => 'required',
        ]);

        $existingStatus = JenisStatus::where('keterangan', $request->keterangan)->first();
        if ($existingStatus) {
            return redirect('/jenis-status')->with('error', 'Data dengan keterangan yang sama sudah ada');
        }

        $jenisStatus = new JenisStatus();
        $jenisStatus->keterangan = $request->keterangan;
        $jenisStatus->save();

        return redirect('/jenis-status')->with('toast_success', 'Data berhasil ditambah');
    }



    public function edit_jenis_status_halaman($id)
    {
        $data = JenisStatus::find($id);
        return view('admin/jenis_status/edit', compact('data'));
    }


    public function edit_jenis_status(Request $request, $id)
    {
        $validated = $request->validate([
            'keterangan' => 'required:jenis_status,keterangan,' . $id,
        ]);

        $existingStatus = JenisStatus::where('keterangan', $request->keterangan)->where('id_jenis_status', '!=', $id)->first();
        if ($existingStatus) {
            return redirect('/jenis-status')->with('error', 'Data dengan keterangan yang sama sudah ada');
        }

        $data = JenisStatus::find($id);
        if ($data) {
            $data->update($request->all());
            return redirect('/jenis-status')->with('toast_success', 'Data berhasil diupdate');
        } else {
            return redirect('/jenis-status')->with('toast_error', 'Data tidak ditemukan');
        }
    }

    public function delete_jenis_status($id)
    {
        $jenisStatus = JenisStatus::where('id_jenis_status', $id)->first();
        if ($jenisStatus) {
            $jenisStatus->is_deleted = $jenisStatus->is_deleted == 1 ? 0 : 1;
            $jenisStatus->save();

            if ($jenisStatus->is_deleted == 0) {
                return redirect()->back()->with('toast_success', 'Jenis Status di Nonaktifkan');
            } else {
                return redirect()->back()->with('toast_success', 'Jenis Status di Aktifkan');
            }
        }

        return redirect()->back()->with('toast_error', 'Data tidak ditemukan.');
    }

    // end jenis status


    // Status
    public function status()
    {
        $data = \App\Models\Status::select('status.*', 'jenis_status.keterangan as jenis_keterangan')
            ->join('jenis_status', 'status.id_jenis_status', '=', 'jenis_status.id_jenis_status')
            ->get();
        $jenisStatus = JenisStatus::all();
        $totalData = $data->count();
        return view('admin/status/index', compact('data', 'totalData', 'jenisStatus'));
    }


    public function tambah_status(Request $request)
    {
        $validated = $request->validate([
            'keterangan' => 'required',
            'id_jenis_status' => 'required',
        ]);
        $existingStatus = Status::where('keterangan', $request->keterangan)
            ->where('id_jenis_status', $request->id_jenis_status)
            ->first();
        if ($existingStatus) {
            return redirect('/status')->with('error', 'Data dengan keterangan dan jenis status yang sama sudah ada');
        }
        $Status = new Status();
        $Status->keterangan = $request->keterangan;
        $Status->id_jenis_status = $request->id_jenis_status;
        $Status->save();

        return redirect('/status')->with('toast_success', 'Data berhasil ditambah');
    }


    public function edit_status_halaman($id)
    {
        $data = Status::find($id);
        $jenisStatus = JenisStatus::all();
        return view('admin/status/edit', compact('data', 'jenisStatus'));
    }


    public function edit_status(Request $request, $id)
    {
        $validated = $request->validate([
            'keterangan' => 'required',
            'id_jenis_status' => 'required',
        ]);
        $existingStatus = Status::where('keterangan', $request->keterangan)
            ->where('id_jenis_status', $request->id_jenis_status)
            ->where('id_status', '!=', $id)
            ->first();
        if ($existingStatus) {
            return redirect()->back()->with('error', 'Data dengan keterangan dan jenis status yang sama sudah ada');
        }
        $data = Status::find($id);
        if ($data) {
            $data->update($request->all());
            return redirect('/status')->with('toast_success', 'Data berhasil diupdate');
        } else {
            return redirect('/status')->with('toast_error', 'Data tidak ditemukan');
        }
    }


    public function delete_status($id)
    {
        $status = Status::where('id_status', $id)->first();
        if ($status) {
            $status->is_deleted = $status->is_deleted == 1 ? 0 : 1;
            $status->save();

            if ($status->is_deleted == 0) {
                return redirect()->back()->with('toast_success', 'Status di Nonaktifkan');
            } else {
                return redirect()->back()->with('toast_success', 'Status di Aktifkan');
            }
        }

        return redirect()->back()->with('toast_error', 'Data tidak ditemukan.');
    }
    //end status


    //pendidikan

    public function pendidikan()
    {
        $data = Pendidikan::all();
        $totalData = $data->count();
        return view('admin/pendidikan/index', compact('data', 'totalData'));
    }

    public function tambah_pendidikan(Request $request)
    {
        $validated = $request->validate([
            'tingkat_pendidikan' => 'required',
        ]);
        $existingStatus = Pendidikan::where('tingkat_pendidikan', $request->tingkat_pendidikan)
            ->first();
        if ($existingStatus) {
            return redirect('/pendidikan')->with('error', 'Data Pendidikan sudah ada');
        }
        $data = new Pendidikan();
        $data->tingkat_pendidikan = $request->tingkat_pendidikan;
        $data->save();

        return redirect('/pendidikan')->with('toast_success', 'Data berhasil ditambah');
    }

    public function edit_pendidikan_halaman($id)
    {
        $data = Pendidikan::find($id);

        return view('admin/pendidikan/edit', compact('data'));
    }


    public function edit_pendidikan(Request $request, $id)
    {
        $validated = $request->validate([
            'tingkat_pendidikan' => 'required',
        ]);
        $existingStatus = Pendidikan::where('tingkat_pendidikan', $request->tingkat_pendidikan)
            ->where('id_pendidikan', '!=', $id)
            ->first();
        if ($existingStatus) {
            return redirect()->back()->with('error', 'Data tingkat pendidikan sudah ada');
        }
        $data = Pendidikan::find($id);
        if ($data) {
            $data->update($request->all());
            return redirect('/pendidikan')->with('toast_success', 'Data berhasil diupdate');
        } else {
            return redirect('/pendidikan')->with('toast_error', 'Data tidak ditemukan');
        }
    }



    public function delete_pendidikan($id)
    {
        $pendidikan = Pendidikan::where('id_pendidikan', $id)->first();
        if ($pendidikan) {
            $pendidikan->is_deleted = $pendidikan->is_deleted == 1 ? 0 : 1;
            $pendidikan->save();

            if ($pendidikan->is_deleted == 0) {
                return redirect()->back()->with('toast_success', 'Pendidikan di Nonaktifkan');
            } else {
                return redirect()->back()->with('toast_success', 'Pendidikan di Aktifkan');
            }
        }

        return redirect()->back()->with('toast_error', 'Data tidak ditemukan.');
    }

    // end pendidikan


    //jabatan
    public function jabatan()
    {
        $data = Jabatan::all();
        $totalData = $data->count();
        return view('admin/jabatan/index', compact('data', 'totalData'));
    }

    public function tambah_jabatan(Request $request)
    {
        $validated = $request->validate([
            'nama_jabatan' => 'required',
            'keterangan' => 'required',
        ]);
        $existingStatus = Jabatan::where('nama_jabatan', $request->nama_jabatan)
            ->first();
        if ($existingStatus) {
            return redirect('/jabatan')->with('error', 'Data sudah ada');
        }
        $data = new Jabatan();
        $data->nama_jabatan = $request->nama_jabatan;
        $data->keterangan = $request->keterangan;
        $data->save();

        return redirect('/jabatan')->with('toast_success', 'Data berhasil ditambah');
    }

    public function edit_jabatan_halaman($id)
    {
        $data = Jabatan::find($id);
        return view('admin/jabatan/edit', compact('data'));
    }


    public function edit_jabatan(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_jabatan' => 'required',
        ]);
        $existingStatus = Jabatan::where('nama_jabatan', $request->nama_jabatan)
            ->where('id_jabatan', '!=', $id)
            ->first();
        if ($existingStatus) {
            return redirect()->back()->with('error', 'Data jabatan sudah ada');
        }
        $data = Jabatan::find($id);
        if ($data) {
            $data->update($request->all());
            return redirect('/jabatan')->with('toast_success', 'Data berhasil diupdate');
        } else {
            return redirect('/jabatan')->with('toast_error', 'Data tidak ditemukan');
        }
    }



    public function delete_jabatan($id)
    {
        $jabatan = Jabatan::where('id_jabatan', $id)->first();
        if ($jabatan) {
            $jabatan->is_deleted = $jabatan->is_deleted == 1 ? 0 : 1;
            $jabatan->save();

            if ($jabatan->is_deleted == 0) {
                return redirect()->back()->with('toast_success', 'Jabatan di Nonaktifkan');
            } else {
                return redirect()->back()->with('toast_success', 'Jabatan di Aktifkan');
            }
        }

        return redirect()->back()->with('toast_error', 'Data tidak ditemukan.');
    }

    //end jabatan

    //pekerjaan
    public function pekerjaan()
    {
        $data = Pekerjaan::all();
        $totalData = $data->count();
        return view('admin/pekerjaan/index', compact('data', 'totalData'));
    }

    public function tambah_pekerjaan(Request $request)
    {
        $validated = $request->validate([
            'nama_pekerjaan' => 'required',
        ]);
        $existingStatus = Pekerjaan::where('nama_pekerjaan', $request->nama_pekerjaan)
            ->first();
        if ($existingStatus) {
            return redirect('/pekerjaan')->with('error', 'Data sudah ada');
        }
        $data = new Pekerjaan();
        $data->nama_pekerjaan = $request->nama_pekerjaan;
        $data->save();

        return redirect('/pekerjaan')->with('toast_success', 'Data berhasil ditambah');
    }

    public function edit_pekerjaan_halaman($id)
    {
        $data = Pekerjaan::find($id);
        return view('admin/pekerjaan/edit', compact('data'));
    }


    public function edit_pekerjaan(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pekerjaan' => 'required',
        ]);
        $existingStatus = Pekerjaan::where('nama_pekerjaan', $request->nama_pekerjaan)
            ->where('id_pekerjaan', '!=', $id)
            ->first();
        if ($existingStatus) {
            return redirect()->back()->with('error', 'Data pekerjaan sudah ada');
        }
        $data = Pekerjaan::find($id);
        if ($data) {
            $data->update($request->all());
            return redirect('/pekerjaan')->with('toast_success', 'Data berhasil diupdate');
        } else {
            return redirect('/pekerjaan')->with('toast_error', 'Data tidak ditemukan');
        }
    }


    public function delete_pekerjaan($id)
    {
        $pekerjaan = Pekerjaan::where('id_pekerjaan', $id)->first();
        if ($pekerjaan) {
            $pekerjaan->is_deleted = $pekerjaan->is_deleted == 1 ? 0 : 1;
            $pekerjaan->save();

            if ($pekerjaan->is_deleted == 0) {
                return redirect()->back()->with('toast_success', 'Pekerjaan di Nonaktifkan');
            } else {
                return redirect()->back()->with('toast_success', 'Pekerjaan di Aktifkan');
            }
        }

        return redirect()->back()->with('toast_error', 'Data tidak ditemukan.');
    }
    //end pekerjaan 



    //hubungan keluarga
    public function hubungan_keluarga()
    {
        $data = HubunganKeluarga::all();
        $totalData = $data->count();
        return view('admin/hubungan_keluarga/index', compact('data', 'totalData'));
    }

    public function tambah_hubungan_keluarga(Request $request)
    {
        $validated = $request->validate([
            'keterangan' => 'required',
        ]);
        $existingStatus = HubunganKeluarga::where('keterangan', $request->keterangan)
            ->first();
        if ($existingStatus) {
            return redirect('/hubungan-keluarga')->with('error', 'Data sudah ada');
        }
        $data = new HubunganKeluarga();
        $data->keterangan = $request->keterangan;
        $data->save();

        return redirect('/hubungan-keluarga')->with('toast_success', 'Data berhasil ditambah');
    }

    public function edit_hubungan_keluarga_halaman($id)
    {
        $data = HubunganKeluarga::find($id);
        return view('admin/hubungan_keluarga/edit', compact('data'));
    }


    public function edit_hubungan_keluarga(Request $request, $id)
    {
        $validated = $request->validate([
            'keterangan' => 'required',
        ]);
        $existingStatus = HubunganKeluarga::where('keterangan', $request->keterangan)
            ->where('id_hubungan_keluarga', '!=', $id)
            ->first();
        if ($existingStatus) {
            return redirect()->back()->with('error', 'Data hubungan keluarga sudah ada');
        }
        $data = HubunganKeluarga::find($id);
        if ($data) {
            $data->update($request->all());
            return redirect('/admin-kepala_keluarga')->with('toast_success', 'Data berhasil diupdate');
        } else {
            return redirect('/admin-kepala_keluarga')->with('toast_error', 'Data tidak ditemukan');
        }
    }

    //bidang
    public function bidang()
    {
        $data = Bidang::all();
        $totalData = $data->count();
        return view('admin/bidang/index', compact('data', 'totalData'));
    }

    public function tambah_bidang(Request $request)
    {
        $validated = $request->validate([
            'nama_bidang' => 'required',
        ]);
        $existingStatus = Bidang::where('nama_bidang', $request->nama_bidang)
            ->first();
        if ($existingStatus) {
            return redirect('/bidang')->with('error', 'Data sudah ada');
        }
        $data = new Bidang();
        $data->nama_bidang = $request->nama_bidang;
        $data->save();

        return redirect('/bidang')->with('toast_success', 'Data berhasil ditambah');
    }

    public function edit_bidang_halaman($id)
    {
        $data = Bidang::find($id);
        return view('admin/bidang/edit', compact('data'));
    }


    public function edit_bidang(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_bidang' => 'required',
        ]);
        $existingStatus = Bidang::where('nama_bidang', $request->nama_bidang)
            ->where('id_bidang', '!=', $id)
            ->first();
        if ($existingStatus) {
            return redirect()->back()->with('error', 'Data bidang sudah ada');
        }
        $data = Bidang::find($id);
        if ($data) {
            $data->update($request->all());
            return redirect('/bidang')->with('toast_success', 'Data berhasil diupdate');
        } else {
            return redirect('/bidang')->with('toast_error', 'Data tidak ditemukan');
        }
    }


    public function delete_bidang($id)
    {
        $bidang = Bidang::where('id_bidang', $id)->first();
        if ($bidang) {
            $bidang->is_deleted = $bidang->is_deleted == 1 ? 0 : 1;
            $bidang->save();

            if ($bidang->is_deleted == 0) {
                return redirect()->back()->with('toast_success', 'Bidang di Nonaktifkan');
            } else {
                return redirect()->back()->with('toast_success', 'Bidang di Aktifkan');
            }
        }

        return redirect()->back()->with('toast_error', 'Data tidak ditemukan.');
    }
    //end bidang

    // ------------------------------------- PUSAT ------------------------------------------

    public function pusat()
    {
        $data = Pusat::all();
        $totalData = $data->count();
        return view('admin/pusat/index', compact('data', 'totalData'));
    }

    public function edit_pusat_show($id)
    {
        $pusat = Pusat::where('id_pusat', $id)->first();
        return view('admin.pusat.edit', compact('pusat'));
    }


    public function edit_pusat(Request $request, $id)
    {
        // dd($request);
        $pusat = Pusat::where('id_pusat', $id)->first(); // Correct column
        if ($pusat) {
            $pusat->nama_pusat = $request->input('nama_pusat');
            $pusat->alamat = $request->input('alamat');
            $pusat->nama_kepala_pusat = $request->input('nama_kepala_pusat');
            // dd($pusat);
            $pusat->save();
            return redirect('/admin-pusat')->with('toast_success', 'Data berhasil diedit');
        } else {
            return redirect('/admin-pusat')->with('toast_error', 'Data tidak ditemukan');
        }
    }



    // -------------------------------- REGIONAL ------------------------------------

    public function regional()
    {
        $data = Regional::join('pusat', 'regional.id_pusat', '=', 'pusat.id_pusat')
            ->select(
                'regional.*',
                'pusat.nama_pusat AS nama_pusat',
            )->get();
        $pusat = Pusat::all();
        $totalData = $data->count();
        return view('admin/regional/index', compact('data', 'totalData', 'pusat'));
    }

    public function edit_regional_show($id)
    {
        $regional = Regional::where('id_pusat', $id)->first();
        return view('admin.regional.edit', compact('regional'));
    }


    public function edit_regional(Request $request, $id)
    {
        // dd($request);
        $regional = Regional::where('id_regional', $id)->first(); // Correct column
        if ($regional) {
            $regional->nama_regional = $request->input('nama_regional');
            $regional->alamat = $request->input('alamat');
            $regional->nama_kepala_regional = $request->input('nama_kepala_regional');
            // dd($regional);
            $regional->save();
            return redirect('/admin-regional')->with('toast_success', 'Data berhasil diedit');
        } else {
            return redirect('/admin-regional')->with('toast_error', 'Data tidak ditemukan');
        }
    }


    // ------------------------------------------ CABANG -------------------------------------------

    public function cabang()
    {
        $data = Cabang::join('regional', 'cabang.id_regional', '=', 'regional.id_regional')
            ->select(
                'cabang.*',
                'regional.nama_regional AS nama_regional',
            )->get();
        $regional = Regional::all();
        $totalData = $data->count();
        return view('admin/cabang/index', compact('data', 'totalData', 'regional'));
    }


    public function edit_cabang_show($id)
    {
        $cabang = Cabang::where('id_cabang', $id)->first();
        return view('admin.cabang.edit', compact('cabang'));
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
            return redirect('/admin-cabang')->with('toast_success', 'Data berhasil diedit');
        } else {
            return redirect('/admin-cabang')->with('toast_error', 'Data tidak ditemukan');
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

        return view('/admin/kepala_keluarga/index', compact('totalData', 'anggota', 'pekerjaans', 'pendidikans', 'sektors', 'statuses'));
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
            return redirect('/admin-kepala_keluarga')->with('toast_success', 'Data berhasil ditambah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/admin-kepala_keluarga')->with('toast_error', 'Gagal menambah data: ' . $e->getMessage());
        }
    }


    public function edit_kepala_keluarga_show($id)
    {
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

        return view('/admin/kepala_keluarga/edit', compact('anggota', 'statuses', 'pekerjaans', 'pendidikans', 'hubunganKeluargas'));
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
            return redirect('/admin-kepala_keluarga')->with('toast_success', 'Data kepala keluarga berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/admin-kepala_keluarga')->with('toast_error', 'Gagal memperbarui data: ' . $e->getMessage());
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

        return view('/admin/kepala_keluarga/detail', compact('pekerjaans', 'statuses', 'pekerjaans', 'pendidikans', 'kepala_keluarga', 'anggota', 'data', 'sektors', 'registrasi_id'));
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

        return view('/admin/anggota/index', compact('totalData', 'anggota', 'statuses', 'pekerjaans', 'pendidikans', 'hubunganKeluargas', 'sektors', 'regAnggota', 'registrasiAnggota'));
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
                'id_status' => 4,
            ]);

            DB::commit();
            return redirect('/admin-anggota')->with('toast_success', 'Data berhasil ditambah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/admin-anggota')->with('toast_error', 'Gagal menambah data: ' . $e->getMessage());
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

        return view('/admin/anggota/edit', compact('anggota', 'statuses', 'pekerjaans', 'pendidikans', 'hubunganKeluargas', 'sektors'));
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
                'id_pekerjaan' => $validated['pekerjaan'],
                'id_pendidikan' => $validated['pendidikan'],
                'keterangan' => $validated['keterangan'],
            ]);

            DB::commit();
            return redirect('/admin-anggota')->with('toast_success', 'Data anggota berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/admin-anggota')->with('toast_error', 'Gagal memperbarui data: ' . $e->getMessage());
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
        return view('admin/sektor/index', compact('data', 'totalData', 'cabang', 'anggota', 'pindah_sektor', 'totalPindah'));
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
        return view('admin.sektor.edit', compact('sektor'));
    }


    public function edit_sektor(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_sektor' => 'required',
            'alamat_sektor' => 'required',
        ]);

        // Cari sektor berdasarkan id
        $sektor = Sektor::where('id_sektor', $id)->first();

        if ($sektor) {
            // Update sektor
            $sektor->nama_sektor = $validated['nama_sektor'];
            $sektor->alamat_sektor = $validated['alamat_sektor'];
            $sektor->save();

            // Update username di tabel user yang sesuai dengan kode sektor
            $user = User::where('kode', $sektor->kode_sektor)->first();
            if ($user) {
                $user->username = $validated['nama_sektor'];
                $user->save();
            }

            return redirect('/admin-sektor')->with('toast_success', 'Data berhasil diedit');
        } else {
            return redirect('/admin-sektor')->with('toast_error', 'Data tidak ditemukan');
        }
    }

    public function tambah_sektor(Request $request)
    {
        $validated = $request->validate([
            'kode_sektor' => 'required|unique:sektor,kode_sektor',
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
            'password' => bcrypt($validated['kode_sektor']),
            'kode' => $sektor->kode_sektor,
            'role' => 'Kepala Sektor'
        ]);

        return redirect('/admin-sektor')->with('toast_success', 'Data berhasil ditambah');
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

        return view('/admin/sektor/detail', compact('current_sektor', 'totalData', 'anggota', 'sektores', 'pendidikans', 'pekerjaans', 'sektors', 'statuses'));
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
            'pejabat_struktural.file AS file',
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

        $statuses = Status::where([
            ['id_jenis_status', 1],
            ['is_deleted', 1]
        ])->get();

        $jabatans = Jabatan::all();
        $bidangs = Bidang::all();
        $anggotas = Anggota::leftJoin('pejabat_struktural', 'anggota.id_anggota', '=', 'pejabat_struktural.id_anggota')
            ->whereNull('pejabat_struktural.id_anggota')
            ->select('anggota.*')
            ->get();
        $totalData = $pejabat->count();


        return view('/admin/pejabat_struktural/index', compact('pejabat', 'totalData', 'statuses', 'bidangs', 'jabatans', 'anggotas'));
    }

    public function tambah_pejabat(Request $request)
    {
        $validated = $request->validate([
            'jabatan' => 'required|exists:jabatan,id_jabatan',
            'anggota' => 'required|exists:anggota,id_anggota',
            'tgl_SK_pengangkatan' => 'required',
            'awal_tahun_jabatan' => 'required',
            'akhir_tahun_jabatan' => 'required',
            'file' => 'required|mimes:jpeg,png,jpg,gif,pdf,doc,docx,txt|max:2048',
            'no_SK_pengangkatan' => 'required',
            'status' => 'required|exists:status,id_status',
            'bidang' => 'required|exists:bidang,id_bidang',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $tujuan_upload = 'assets/file';
            $file->move($tujuan_upload, $nama_file);
        } else {
            return redirect('/admin-pejabat')->with('toast_error', 'File tidak ditemukan');
        }

        try {
            DB::beginTransaction();

            PejabatStruktural::create([
                'id_jabatan' => $validated['jabatan'],
                'id_anggota' => $validated['anggota'],
                'tgl_SK_pengangkatan' => $validated['tgl_SK_pengangkatan'],
                'awal_tahun_jabatan' => $validated['awal_tahun_jabatan'],
                'akhir_tahun_jabatan' => $validated['akhir_tahun_jabatan'],
                'file' => $nama_file,
                'no_SK_pengangkatan' => $validated['no_SK_pengangkatan'],
                'id_status' => $validated['status'],
                'id_bidang' => $validated['bidang'],
            ]);

            DB::commit();

            return redirect('/admin-pejabat')->with('toast_success', 'Data berhasil ditambah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/admin-pejabat')->with('toast_error', 'Terjadi kesalahan saat menambah data: ' . $e->getMessage());
        }
    }


    public function edit_pejabat_show($id)
    {
        $pejabat = PejabatStruktural::where('id_pejabat_struktural', $id)->first();
        return view('admin.pejabat_struktural.edit', compact('pejabat'));
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
            return redirect('/admin-pejabat')->with('toast_success', 'Data berhasil diedit');
        } else {
            return redirect('/admin-pejabat')->with('toast_error', 'Data tidak ditemukan');
        }
    }
}
