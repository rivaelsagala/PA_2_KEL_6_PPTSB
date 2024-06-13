<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrasiAnggota extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_registrasi';
    protected $table = 'registrasi_anggota';
    public $timestamps = true;
    protected $fillable = [
        'no_registrasi',
        'tgl_registrasi',
        'id_sektor'
    ];
}
