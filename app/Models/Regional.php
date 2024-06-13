<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regional extends Model
{
    use HasFactory;

    protected $table = 'regional';
    protected $primaryKey = 'id_regional';
    protected $fillable = [
        'kode_regional',
        'nama_regional',
        'alamat',
        'nama_kepala_pusat',
        'nama_pusat',
    ];
}
