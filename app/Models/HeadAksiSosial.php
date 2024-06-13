<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadAksiSosial extends Model
{
    use HasFactory;
    protected $table = 'head_aksi_sosial';
    protected $primaryKey = 'id_head_aksi';
    protected $fillable = [
        'id_kegiatan',
        'nama_aksi_sosial',
    ];
}
