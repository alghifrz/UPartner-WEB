<?php

namespace App\Models;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Iklan extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'dosen_id',
        'gambar',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }


    // public function dosen()
    // {
    //     return $this->hasMany(Dosen::class);
    // } 
}
