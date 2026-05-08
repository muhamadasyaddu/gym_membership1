<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketGym extends Model
{
    use HasFactory;

    protected $table = 'paket_gym';

    protected $fillable = [
        'nama_paket',
        'durasi_hari',
        'harga',
        'deskripsi',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    /**
     * Relationship with Transaksi
     */
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'paket_id');
    }

    /**
     * Get formatted price
     */
    public function getFormattedHargaAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    /**
     * Get duration label
     */
    public function getDurasiLabelAttribute(): string
    {
        if ($this->durasi_hari >= 30) {
            $bulan = intval($this->durasi_hari / 30);
            return $bulan . ' Bulan';
        }
        return $this->durasi_hari . ' Hari';
    }
}