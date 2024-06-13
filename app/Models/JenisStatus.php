<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisStatus extends Model
{
    use HasFactory;

    protected $table = 'jenis_status'; 
    protected $primaryKey = 'id_jenis_status';

    protected $fillable = [
        'keterangan'
    ];

    public function statuses()
    {
        return $this->hasMany(Status::class, 'id_jenis_status');
    }
}
