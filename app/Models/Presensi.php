<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'presensi';

    protected $fillable = [
        'transaksi_id',
        'waktu_masuk',
    ];

    protected $casts = [
        'waktu_masuk' => 'datetime',
    ];

    /**
     * Relationship with Transaksi
     */
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    /**
     * Get formatted waktu masuk
     */
    public function getFormattedWaktuAttribute(): string
    {
        return $this->waktu_masuk->format('d/m/Y H:i');
    }

    /**
     * Get tanggal only
     */
    public function getTanggalAttribute(): string
    {
        return $this->waktu_masuk->format('d/m/Y');
    }

    /**
     * Get jam only
     */
    public function getJamAttribute(): string
    {
        return $this->waktu_masuk->format('H:i');
    }
}