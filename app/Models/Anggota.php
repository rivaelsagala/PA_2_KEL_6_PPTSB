<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_anggota';
    protected $table = 'anggota';
    public $timestamps = true;
    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'gelar_depan',
        'gelar_belakang',
        'tempat_lahir',
        'alamat',
        'no_telepon',
        'foto',
        'id_status',
        'id_hubungan_keluarga',
        'id_jabatan',
        'id_pekerjaan',
        'id_pendidikan',
        'keterangan',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status','id_status');
    }

    public function hubunganKeluarga()
    {
        return $this->belongsTo(HubunganKeluarga::class, 'id_hubungan_keluarga','id_hubungan_keluarga');
    }

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'id_pekerjaan','id_pekerjaan');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan','id_jabatan');
    }

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class, 'id_pendidikan','id_pendidikan');
    }

}
