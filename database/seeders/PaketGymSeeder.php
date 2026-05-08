<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaketGym;

class PaketGymSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paketData = [
            [
                'nama_paket' => 'Paket Harian',
                'durasi_hari' => 1,
                'harga' => 50000,
                'deskripsi' => 'Akses gym selama 1 hari. Cocok untuk yang ingin mencoba fasilitas kami.',
            ],
            [
                'nama_paket' => 'Paket Mingguan',
                'durasi_hari' => 7,
                'harga' => 150000,
                'deskripsi' => 'Akses gym selama 7 hari. Hemat 50% dibanding harian!',
            ],
            [
                'nama_paket' => 'Paket Bulanan',
                'durasi_hari' => 30,
                'harga' => 350000,
                'deskripsi' => 'Akses gym selama 30 hari. Pilihan terpopuler untuk rutin berolahraga.',
            ],
            [
                'nama_paket' => 'Paket 3 Bulan',
                'durasi_hari' => 90,
                'harga' => 900000,
                'deskripsi' => 'Akses gym selama 90 hari. Hemat lebih banyak dengan paket ini!',
            ],
            [
                'nama_paket' => 'Paket 6 Bulan',
                'durasi_hari' => 180,
                'harga' => 1600000,
                'deskripsi' => 'Akses gym selama 6 bulan. Pilihan terbaik untuk komitmen jangka panjang.',
            ],
            [
                'nama_paket' => 'Paket Tahunan',
                'durasi_hari' => 365,
                'harga' => 2800000,
                'deskripsi' => 'Akses gym selama 1 tahun. Paket paling hemat dengan diskon spesial!',
            ],
        ];

        foreach ($paketData as $data) {
            PaketGym::create($data);
        }

        $this->command->info('PaketGym seeded successfully! Total: ' . count($paketData) . ' packages.');
    }
}