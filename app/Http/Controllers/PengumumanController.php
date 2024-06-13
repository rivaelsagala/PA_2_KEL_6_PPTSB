<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\DetAksiSosial;
use App\Models\HeadAksiSosial;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class PengumumanController extends Controller
{
    public function pengumuman()
    {
        $kegiatan = Kegiatan::select('kegiatan.nama_kegiatan', 'kegiatan.id_kegiatan', 'kegiatan.gambar', 'kegiatan.tempat', 'kegiatan.tanggal', 'kegiatan.waktu', 'head_aksi_sosial.nama_aksi_sosial', 'det_aksi_sosial.jumlah_bantuan', 'det_aksi_sosial.keterangan', 'anggota.nama_depan')
            ->join('head_aksi_sosial', 'kegiatan.id_kegiatan', '=', 'head_aksi_sosial.id_kegiatan')
            ->join('det_aksi_sosial', 'head_aksi_sosial.id_head_aksi', '=', 'det_aksi_sosial.id_head_aksi')
            ->join('anggota', 'det_aksi_sosial.id_anggota', '=', 'anggota.id_anggota')
            ->get();

        $anggota = Anggota::all();

        $totalData = $kegiatan->count();

        return view('/admin/pengumuman/index', compact('anggota', 'kegiatan', 'totalData'));
    }

    public function tambah_pengumuman(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|in:Kegiatan,Pengumuman',
            'gambar' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tanggal' => 'required',
            'waktu' => 'required',
            'tempat' => 'required',
            'nama_aksi_sosial' => 'required',
            'jumlah_bantuan' => 'sometimes',
            'keterangan' => 'required',
            'id_anggota' => [
                'sometimes',
                function ($attribute, $value, $fail) {
                    if ($value != 0 && !DB::table('anggota')->where('id_anggota', $value)->exists()) {
                        $fail('The selected ' . $attribute . ' is invalid.');
                    }
                }
            ]
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
            $detAksiSosial->id_anggota = $request->id_anggota != 0 ? $request->id_anggota : null; // Handle the case when no anggota is selected
            $detAksiSosial->save();

            return redirect('/admin-pengumuman')->with('toast_success', 'Data berhasil ditambah');
        } else {
            return redirect('/admin-pengumuman')->with('toast_error', 'Foto tidak ditemukan');
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
        return view('admin/pengumuman/edit', compact('kegiatan', 'anggota'));
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
            return redirect('/admin-pengumuman')->with('toast_success', 'Data pengumuman berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/admin-pengumuman')->with('toast_error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function delete_pengumuman($id)
    {
        $delete = Kegiatan::where('id_kegiatan', $id)->delete();
        if ($delete) {
            return redirect('/admin-pengumuman');
        } else {
            return redirect('/admin-pengumuman')->with(['error' => "Gagal Di Hapus!"]);
        }
    }
}
