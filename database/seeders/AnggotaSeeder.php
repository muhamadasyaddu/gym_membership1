<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anggota;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $anggotaData = [
            [
                'nama' => 'Ahmad Fauzi',
                'jenis_kelamin' => 'laki_laki',
                'no_telp' => '081234567801',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta Selatan',
                'tanggal_daftar' => '2025-01-15',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Dewi Lestari',
                'jenis_kelamin' => 'perempuan',
                'no_telp' => '081234567802',
                'alamat' => 'Jl. Sudirman No. 25, Jakarta Pusat',
                'tanggal_daftar' => '2025-01-20',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Rizky Pratama',
                'jenis_kelamin' => 'laki_laki',
                'no_telp' => '081234567803',
                'alamat' => 'Jl. Gatot Subroto No. 5, Jakarta Selatan',
                'tanggal_daftar' => '2025-02-01',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Putri Wulandari',
                'jenis_kelamin' => 'perempuan',
                'no_telp' => '081234567804',
                'alamat' => 'Jl. Thamrin No. 15, Jakarta Pusat',
                'tanggal_daftar' => '2025-02-10',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Bima Sakti',
                'jenis_kelamin' => 'laki_laki',
                'no_telp' => '081234567805',
                'alamat' => 'Jl. Rasuna Said No. 8, Jakarta Selatan',
                'tanggal_daftar' => '2025-02-15',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Rina Susanti',
                'jenis_kelamin' => 'perempuan',
                'no_telp' => '081234567806',
                'alamat' => 'Jl. Kuningan No. 12, Jakarta Selatan',
                'tanggal_daftar' => '2025-02-20',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Eko Prasetyo',
                'jenis_kelamin' => 'laki_laki',
                'no_telp' => '081234567807',
                'alamat' => 'Jl. Fatmawati No. 30, Jakarta Selatan',
                'tanggal_daftar' => '2025-03-01',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Maya Indah Sari',
                'jenis_kelamin' => 'perempuan',
                'no_telp' => '081234567808',
                'alamat' => 'Jl. Pondok Indah No. 7, Jakarta Selatan',
                'tanggal_daftar' => '2025-03-05',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Fajar Nugroho',
                'jenis_kelamin' => 'laki_laki',
                'no_telp' => '081234567809',
                'alamat' => 'Jl. Kemang No. 18, Jakarta Selatan',
                'tanggal_daftar' => '2025-03-10',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Lestari Wati',
                'jenis_kelamin' => 'perempuan',
                'no_telp' => '081234567810',
                'alamat' => 'Jl. TB Simatupang No. 22, Jakarta Timur',
                'tanggal_daftar' => '2025-03-15',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Hendra Wijaya',
                'jenis_kelamin' => 'laki_laki',
                'no_telp' => '081234567811',
                'alamat' => 'Jl. Casablanca No. 9, Jakarta Timur',
                'tanggal_daftar' => '2025-03-20',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Nur Aini',
                'jenis_kelamin' => 'perempuan',
                'no_telp' => '081234567812',
                'alamat' => 'Jl. Kalibata No. 14, Jakarta Selatan',
                'tanggal_daftar' => '2025-03-25',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Agus Setiawan',
                'jenis_kelamin' => 'laki_laki',
                'no_telp' => '081234567813',
                'alamat' => 'Jl. MT Haryono No. 3, Jakarta Timur',
                'tanggal_daftar' => '2025-04-01',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Ratna Dewi',
                'jenis_kelamin' => 'perempuan',
                'no_telp' => '081234567814',
                'alamat' => 'Jl. Pancoran No. 11, Jakarta Selatan',
                'tanggal_daftar' => '2025-04-05',
                'status' => 'nonaktif',
            ],
            [
                'nama' => 'Yoga Permana',
                'jenis_kelamin' => 'laki_laki',
                'no_telp' => '081234567815',
                'alamat' => 'Jl. Tebet No. 6, Jakarta Selatan',
                'tanggal_daftar' => '2025-04-10',
                'status' => 'nonaktif',
            ],
            [
                'nama' => 'Indah Permata',
                'jenis_kelamin' => 'perempuan',
                'no_telp' => '081234567816',
                'alamat' => 'Jl. Cikini No. 20, Jakarta Pusat',
                'tanggal_daftar' => '2025-04-12',
                'status' => 'nonaktif',
            ],
            [
                'nama' => 'Dodi Firmansyah',
                'jenis_kelamin' => 'laki_laki',
                'no_telp' => '081234567817',
                'alamat' => 'Jl. Senayan No. 4, Jakarta Pusat',
                'tanggal_daftar' => '2025-04-15',
                'status' => 'nonaktif',
            ],
            [
                'nama' => 'Wulan Sari',
                'jenis_kelamin' => 'perempuan',
                'no_telp' => '081234567818',
                'alamat' => 'Jl. Slipi No. 17, Jakarta Barat',
                'tanggal_daftar' => '2025-04-18',
                'status' => 'nonaktif',
            ],
            [
                'nama' => 'Rendi Saputra',
                'jenis_kelamin' => 'laki_laki',
                'no_telp' => '081234567819',
                'alamat' => 'Jl. Palmerah No. 28, Jakarta Barat',
                'tanggal_daftar' => '2025-04-20',
                'status' => 'nonaktif',
            ],
            [
                'nama' => 'Anisa Fitri',
                'jenis_kelamin' => 'perempuan',
                'no_telp' => '081234567820',
                'alamat' => 'Jl. Grogol No. 35, Jakarta Barat',
                'tanggal_daftar' => '2025-04-22',
                'status' => 'nonaktif',
            ],
        ];

        foreach ($anggotaData as $data) {
            Anggota::create($data);
        }

        $this->command->info('Anggota seeded successfully! Total: ' . count($anggotaData) . ' members.');
    }
}