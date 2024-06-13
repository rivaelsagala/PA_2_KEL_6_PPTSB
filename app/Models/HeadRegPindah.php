<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadRegPindah extends Model
{
    use HasFactory;
    protected $table = 'head_reg_pindah';
    protected $primaryKey = 'id_reg_pindah';
    protected $fillable = [
        'no_reg_pindah',
        'tgl_pindah',
        'file_surat_pindah',
        'id_registrasi',
        'id_status',
        'id_sektor_tujuan',
    ];
}
