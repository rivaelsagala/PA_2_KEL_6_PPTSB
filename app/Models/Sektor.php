<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sektor extends Model
{
    use HasFactory;

    protected $table = 'sektor';
    protected $primaryKey = 'id_sektor';
    protected $fillable = [
        'kode_sektor',
        'nama_sektor',
        'alamat_sektor',
        'tgl_berdiri',
        'id_cabang'
    ];
}
