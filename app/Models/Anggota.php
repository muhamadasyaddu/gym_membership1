<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'anggota';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'no_telp',
        'alamat',
        'tanggal_daftar',
        'jenis_kelamin',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_daftar' => 'datetime',
    ];

    /**
     * Relasi One to Many dengan Presensi
     * Anggota memiliki banyak presensi
     */
    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'anggota_id');
    }

    /**
     * Relasi One to Many dengan Transaksi
     * Anggota memiliki banyak transaksi
     */
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'anggota_id');
    }

    /**
     * Get jenis kelamin label
     */
    public function getJenisKelaminLabelAttribute(): string
    {
        return $this->jenis_kelamin === 'laki_laki' ? 'Laki-laki' : 'Perempuan';
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status === 'aktif' ? 'Aktif' : 'Tidak Aktif';
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeAttribute(): string
    {
        return $this->status === 'aktif' ? 'success' : 'danger';
    }

     /**
     * Get anggota initials for avatar
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->nama);
        $initials = '';
        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
            if (strlen($initials) >= 2) break;
        }
        return $initials ?: 'A';
    }
}