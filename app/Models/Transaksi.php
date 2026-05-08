<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'transaksi';

    protected $fillable = [
        'anggota_id',
        'paket_id',
        'waktu_mulai',
        'waktu_berakhir',
        'total_harga',
        'payment_method',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'waktu_mulai' => 'date',
        'waktu_berakhir' => 'date',
        'total_harga' => 'decimal:2',
    ];

    /**
     * Relationship with Anggota
     */
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    /**
     * Relationship with PaketGym
     */
    public function paket()
    {
        return $this->belongsTo(PaketGym::class, 'paket_id');
    }

    /**
     * Get formatted total price
     */
    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    /**
     * Get payment method label
     */
    public function getPaymentMethodLabelAttribute(): string
    {
        $labels = [
            'tunai' => 'Tunai',
            'e-wallet' => 'E-Wallet',
        ];
        return $labels[$this->payment_method] ?? $this->payment_method;
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status === 'lunas' ? 'Lunas' : 'Pending';
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeAttribute(): string
    {
        return $this->status === 'lunas' ? 'success' : 'warning';
    }

    /**
     * Check if membership is still active
     */
    public function isMembershipActive(): bool
    {
        return $this->waktu_berakhir->gte(now()) && $this->status === 'lunas';
    }
}