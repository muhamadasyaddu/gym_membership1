<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatGym extends Model
{
    use HasFactory;

    protected $table = 'alat_gym';

    protected $fillable = [
        'nama',
        'merek',
        'kondisi',
        'waktu_pembelian',
        'keterangan',
    ];

    protected $casts = [
        'waktu_pembelian' => 'date',
    ];

    /**
     * Get kondisi label
     */
    public function getKondisiLabelAttribute(): string
    {
        $labels = [
            'baik' => 'Baik',
            'rusak_ringan' => 'Rusak Ringan',
            'rusak_berat' => 'Rusak Berat',
        ];
        return $labels[$this->kondisi] ?? $this->kondisi;
    }

    /**
     * Get kondisi badge color
     */
    public function getKondisiBadgeAttribute(): string
    {
        $badges = [
            'baik' => 'success',
            'rusak_ringan' => 'warning',
            'rusak_berat' => 'danger',
        ];
        return $badges[$this->kondisi] ?? 'secondary';
    }
}