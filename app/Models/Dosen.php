<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Prodi;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dosen extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $guard = 'dosen';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nip',
        'name',
        'email',
        'password',
        'prodi_id',
        'photo',
        'bio',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function proyekDikelola()
    {
        return $this->hasMany(Proyek::class, 'proyek_manajer_id');
    }

    public function iklanDikelola()
    {
        return $this->hasMany(Iklan::class, 'dosen_id');
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_dosen');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
