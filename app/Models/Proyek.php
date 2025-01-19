<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Kegiatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proyek extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'judul_proyek',
        'deskripsi_proyek',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_proyek',
        'persyaratan_kemampuan',
        'role',
        'sampul',
        'proyek_manajer_id',
    ];

    public function proyekManajer()
    {
        return $this->belongsTo(Dosen::class, 'proyek_manajer_id');
    }

    public function kegiatan(): HasMany
    {
        return $this->hasMany(Kegiatan::class);
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_proyek');
    }

    protected $casts = [
        'persyaratan_kemampuan' => 'array',
        'role' => 'array',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',  // Cast kolom persyaratan_kemampuan menjadi array
    ];


    // public function dosen()
    // {
    //     return $this->hasMany(Dosen::class);
    // } 
}
