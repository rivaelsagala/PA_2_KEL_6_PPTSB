<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class UserController extends Controller
{


    public function user()
    {

        $kegiatan = Kegiatan::select('kegiatan.nama_kegiatan', 'kegiatan.id_kegiatan', 'kegiatan.gambar', 'kegiatan.tempat', 'kegiatan.tanggal', 'kegiatan.waktu', 'head_aksi_sosial.nama_aksi_sosial', 'det_aksi_sosial.jumlah_bantuan', 'det_aksi_sosial.keterangan', 'anggota.nama_depan')
            ->join('head_aksi_sosial', 'kegiatan.id_kegiatan', '=', 'head_aksi_sosial.id_kegiatan')
            ->join('det_aksi_sosial', 'head_aksi_sosial.id_head_aksi', '=', 'det_aksi_sosial.id_head_aksi')
            ->join('anggota', 'det_aksi_sosial.id_anggota', '=', 'anggota.id_anggota')
            ->where('nama_kegiatan', '=', 'kegiatan')
            ->get();

        $pengumuman = Kegiatan::select('kegiatan.nama_kegiatan', 'kegiatan.id_kegiatan', 'kegiatan.gambar', 'kegiatan.tempat', 'kegiatan.tanggal', 'kegiatan.waktu', 'head_aksi_sosial.nama_aksi_sosial', 'det_aksi_sosial.jumlah_bantuan', 'det_aksi_sosial.keterangan', 'anggota.nama_depan')
            ->join('head_aksi_sosial', 'kegiatan.id_kegiatan', '=', 'head_aksi_sosial.id_kegiatan')
            ->join('det_aksi_sosial', 'head_aksi_sosial.id_head_aksi', '=', 'det_aksi_sosial.id_head_aksi')
            ->join('anggota', 'det_aksi_sosial.id_anggota', '=', 'anggota.id_anggota')
            ->where('nama_kegiatan', '=', 'pengumuman')
            ->get();


        $totalData = $kegiatan->count();
        return view('user/index', compact('kegiatan', 'totalData', 'pengumuman'));
    }



    public function pengumuman()
    {
        $kegiatan = Kegiatan::select('kegiatan.nama_kegiatan', 'kegiatan.id_kegiatan', 'kegiatan.gambar', 'kegiatan.tempat', 'kegiatan.tanggal', 'kegiatan.waktu', 'head_aksi_sosial.nama_aksi_sosial', 'det_aksi_sosial.jumlah_bantuan', 'det_aksi_sosial.keterangan', 'anggota.nama_depan')
            ->join('head_aksi_sosial', 'kegiatan.id_kegiatan', '=', 'head_aksi_sosial.id_kegiatan')
            ->join('det_aksi_sosial', 'head_aksi_sosial.id_head_aksi', '=', 'det_aksi_sosial.id_head_aksi')
            ->join('anggota', 'det_aksi_sosial.id_anggota', '=', 'anggota.id_anggota')
            ->where('nama_kegiatan', '=', 'kegiatan')
            ->get();

        $pengumuman = Kegiatan::select('kegiatan.nama_kegiatan', 'kegiatan.id_kegiatan', 'kegiatan.gambar', 'kegiatan.tempat', 'kegiatan.tanggal', 'kegiatan.waktu', 'head_aksi_sosial.nama_aksi_sosial', 'det_aksi_sosial.jumlah_bantuan', 'det_aksi_sosial.keterangan', 'anggota.nama_depan')
            ->join('head_aksi_sosial', 'kegiatan.id_kegiatan', '=', 'head_aksi_sosial.id_kegiatan')
            ->join('det_aksi_sosial', 'head_aksi_sosial.id_head_aksi', '=', 'det_aksi_sosial.id_head_aksi')
            ->join('anggota', 'det_aksi_sosial.id_anggota', '=', 'anggota.id_anggota')
            ->where('nama_kegiatan', '=', 'pengumuman')
            ->get();


        $totalData = $kegiatan->count();
        return view('user/pengumuman', compact('kegiatan', 'totalData', 'pengumuman'));
    }


    public function sejarah()
    {
        return view('user.sejarah');
    }


    public function detsSektor()
    {
        return view('user.detsektor');
    }

    public function detpengumuman()
    {

        $kegiatan = Kegiatan::select('kegiatan.nama_kegiatan', 'kegiatan.id_kegiatan', 'kegiatan.gambar', 'kegiatan.tempat', 'kegiatan.tanggal', 'kegiatan.waktu', 'head_aksi_sosial.nama_aksi_sosial', 'det_aksi_sosial.jumlah_bantuan', 'det_aksi_sosial.keterangan', 'anggota.nama_depan')
            ->join('head_aksi_sosial', 'kegiatan.id_kegiatan', '=', 'head_aksi_sosial.id_kegiatan')
            ->join('det_aksi_sosial', 'head_aksi_sosial.id_head_aksi', '=', 'det_aksi_sosial.id_head_aksi')
            ->join('anggota', 'det_aksi_sosial.id_anggota', '=', 'anggota.id_anggota')
            ->where('nama_kegiatan', '=', 'kegiatan')
            ->get();

        $pengumuman = Kegiatan::select('kegiatan.nama_kegiatan', 'kegiatan.id_kegiatan', 'kegiatan.gambar', 'kegiatan.tempat', 'kegiatan.tanggal', 'kegiatan.waktu', 'head_aksi_sosial.nama_aksi_sosial', 'det_aksi_sosial.jumlah_bantuan', 'det_aksi_sosial.keterangan', 'anggota.nama_depan')
            ->join('head_aksi_sosial', 'kegiatan.id_kegiatan', '=', 'head_aksi_sosial.id_kegiatan')
            ->join('det_aksi_sosial', 'head_aksi_sosial.id_head_aksi', '=', 'det_aksi_sosial.id_head_aksi')
            ->join('anggota', 'det_aksi_sosial.id_anggota', '=', 'anggota.id_anggota')
            ->where('nama_kegiatan', '=', 'pengumuman')
            ->get();

        $anggota = Anggota::all();

        $totalData = $kegiatan->count();
        return view('user.detpengumuman', compact('anggota', 'kegiatan', 'totalData', 'pengumuman'));
    }
}
