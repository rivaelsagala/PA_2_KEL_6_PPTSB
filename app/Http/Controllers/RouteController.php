<?php

namespace App\Http\Controllers;

use App\Models\Pusat;
use App\Models\Cabang;
use App\Models\Sektor;
use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\Regional;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function pusat()
    {
        $pusat = Pusat ::all();

        $pengumuman = Kegiatan::select('kegiatan.nama_kegiatan', 'kegiatan.id_kegiatan', 'kegiatan.gambar', 'kegiatan.tempat', 'kegiatan.tanggal', 'kegiatan.waktu', 'head_aksi_sosial.nama_aksi_sosial', 'det_aksi_sosial.jumlah_bantuan', 'det_aksi_sosial.keterangan', 'anggota.nama_depan')
        ->join('head_aksi_sosial', 'kegiatan.id_kegiatan', '=', 'head_aksi_sosial.id_kegiatan')
        ->join('det_aksi_sosial', 'head_aksi_sosial.id_head_aksi', '=', 'det_aksi_sosial.id_head_aksi')
        ->join('anggota', 'det_aksi_sosial.id_anggota', '=', 'anggota.id_anggota')
        ->get();

    
        return view('user.pusat',compact('pusat','pengumuman'));
    }

    public function regional()
    {
        $regional = Regional ::all();

        $pengumuman = Kegiatan::select('kegiatan.nama_kegiatan', 'kegiatan.id_kegiatan', 'kegiatan.gambar', 'kegiatan.tempat', 'kegiatan.tanggal', 'kegiatan.waktu', 'head_aksi_sosial.nama_aksi_sosial', 'det_aksi_sosial.jumlah_bantuan', 'det_aksi_sosial.keterangan', 'anggota.nama_depan')
        ->join('head_aksi_sosial', 'kegiatan.id_kegiatan', '=', 'head_aksi_sosial.id_kegiatan')
        ->join('det_aksi_sosial', 'head_aksi_sosial.id_head_aksi', '=', 'det_aksi_sosial.id_head_aksi')
        ->join('anggota', 'det_aksi_sosial.id_anggota', '=', 'anggota.id_anggota')
        ->get();

        return view('user.regional',compact('regional','pengumuman'));
    }

    public function cabang()
    {
        $cabang = Cabang ::all();

        $pengumuman = Kegiatan::select('kegiatan.nama_kegiatan', 'kegiatan.id_kegiatan', 'kegiatan.gambar', 'kegiatan.tempat', 'kegiatan.tanggal', 'kegiatan.waktu', 'head_aksi_sosial.nama_aksi_sosial', 'det_aksi_sosial.jumlah_bantuan', 'det_aksi_sosial.keterangan', 'anggota.nama_depan')
        ->join('head_aksi_sosial', 'kegiatan.id_kegiatan', '=', 'head_aksi_sosial.id_kegiatan')
        ->join('det_aksi_sosial', 'head_aksi_sosial.id_head_aksi', '=', 'det_aksi_sosial.id_head_aksi')
        ->join('anggota', 'det_aksi_sosial.id_anggota', '=', 'anggota.id_anggota')
        ->get();

        return view('user.cabang',compact('cabang','pengumuman'));
    }

    public function sektor()
    {

        $sektor = Anggota::select(
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

        $pengumuman = Kegiatan::select('kegiatan.nama_kegiatan', 'kegiatan.id_kegiatan', 'kegiatan.gambar', 'kegiatan.tempat', 'kegiatan.tanggal', 'kegiatan.waktu', 'head_aksi_sosial.nama_aksi_sosial', 'det_aksi_sosial.jumlah_bantuan', 'det_aksi_sosial.keterangan', 'anggota.nama_depan')
        ->join('head_aksi_sosial', 'kegiatan.id_kegiatan', '=', 'head_aksi_sosial.id_kegiatan')
        ->join('det_aksi_sosial', 'head_aksi_sosial.id_head_aksi', '=', 'det_aksi_sosial.id_head_aksi')
        ->join('anggota', 'det_aksi_sosial.id_anggota', '=', 'anggota.id_anggota')
        ->get();

        return view('user.sektor',compact('sektor','pengumuman'));
    }
}
