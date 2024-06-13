<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PejabatStruktural extends Model
{
    use HasFactory;
    protected $table = 'pejabat_struktural';
    protected $primaryKey = 'id_pejabat_struktural';
    protected $fillable = [
        'id_jabatan',
        'id_anggota',
        'tgl_SK_pengangkatan',
        'file',
        'no_SK_pengangkatan',
        'awal_tahun_jabatan',
        'akhir_tahun_jabatan',
        'id_status',
        'id_bidang'
    ];
}
