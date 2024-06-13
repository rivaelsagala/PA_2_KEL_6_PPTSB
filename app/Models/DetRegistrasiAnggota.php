<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetRegistrasiAnggota extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_det_registrasi';
    protected $table = 'det_registrasi_anggota';
    public $timestamps = true;
    protected $fillable = [
        'id_registrasi',
        'id_anggota',
        'id_status'
    ];
}
