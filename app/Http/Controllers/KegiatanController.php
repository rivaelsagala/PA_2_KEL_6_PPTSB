<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class KegiatanController extends Controller
{
    public function showById($id)
    {
        $pengumuman = Kegiatan::select(
            'kegiatan.nama_kegiatan',
            'kegiatan.id_kegiatan',
            'kegiatan.gambar',
            'kegiatan.tempat',
            'kegiatan.tanggal',
            'kegiatan.waktu',
            'head_aksi_sosial.nama_aksi_sosial',
            'det_aksi_sosial.jumlah_bantuan',
            'det_aksi_sosial.keterangan',
            'anggota.nama_depan'
        )
        ->join('head_aksi_sosial', 'kegiatan.id_kegiatan', '=', 'head_aksi_sosial.id_kegiatan')
        ->join('det_aksi_sosial', 'head_aksi_sosial.id_head_aksi', '=', 'det_aksi_sosial.id_head_aksi')
        ->join('anggota', 'det_aksi_sosial.id_anggota', '=', 'anggota.id_anggota')
        ->where('kegiatan.id_kegiatan', $id)
        ->firstOrFail();

        return view('user.detpengumuman', compact('pengumuman'));
    }
}



