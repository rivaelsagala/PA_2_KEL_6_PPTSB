<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPindah extends Model
{
    use HasFactory;
    protected $table = 'detail_pindah';
    protected $primaryKey = 'id_detail_reg_pindah';
    protected $fillable = [
        'id_reg_pindah',
        'id_anggota',
    ];
}
