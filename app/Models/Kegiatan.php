<?php

namespace App\Models;

use App\Models\Proyek;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kegiatan extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'proyek_id',
        'nama',
        'tanggal_mulai',
        'tanggal_selesai',
        'is_selesai',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    /**
     * Relasi Kegiatan ke Proyek (Many to One)
     */
    public function proyek(): BelongsTo
    {
        return $this->belongsTo(Proyek::class);
    }
}
?>
