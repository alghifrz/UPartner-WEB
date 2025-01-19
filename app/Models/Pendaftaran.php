<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftarans';

    protected $fillable = [
        'id_proyek',
        'id_mahasiswa',
        'id_dosen',
        'status',
        'alasan_mendaftar',
        'persyaratan_kemampuan',
        'role'
    ];

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'id_proyek');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'id_mahasiswa');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }
}
