<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Proyek extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'judul_proyek',
        'deskripsi_proyek',
        'status_proyek',
        'nip',
    ];

    public function dosen()
    {
        return $this->hasMany(Dosen::class);
    } 
}
