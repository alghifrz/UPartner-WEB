<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prodi extends Model
{

    use HasFactory;

    // Tentukan kolom-kolom yang dapat diisi
    protected $fillable = ['prodi_name'];

    // Relasi ke mahasiswa
    public function mahasiswa()
    {
        return $this->hasMany(User::class);
    }
    
    public function dosen()
    {
        return $this->hasMany(Dosen::class);
    }
}
