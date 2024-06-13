<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $table = 'cabang';
    protected $primaryKey = 'id_cabang';

    protected $fillable = [
        'kode_cabang',
        'nama_cabang',
        'alamat',
        'nama_kepala_cabang',
        'tgl_berdiri',
        'nama_regional',
    ];
}
