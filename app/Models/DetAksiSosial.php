<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetAksiSosial extends Model
{
    use HasFactory;
    protected $table = 'det_aksi_sosial';
    protected $primaryKey = 'id_det_aksi';
    protected $fillable = [
        'id_anggota',
        'id_head_aksi',
        'jumlah_bantuan',
        'keterangan',
    ];
}
