<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\Anggota;
use App\Models\PaketGym;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $anggotaList = Anggota::where('status', 'aktif')->get();
        $paketList = PaketGym::all();

        if ($anggotaList->isEmpty() || $paketList->isEmpty()) {
            $this->command->warn('Please run AnggotaSeeder and PaketGymSeeder first!');
            return;
        }

        $transactions = [];

        // Create transactions for active members
        foreach ($anggotaList as $index => $anggota) {
            // Random paket
            $paket = $paketList->random();
            
            // Random start date in the last 3 months
            $waktuMulai = Carbon::now()->subDays(rand(1, 90));
            
            // Calculate end date based on paket duration
            $waktuBerakhir = $waktuMulai->copy()->addDays($paket->durasi_hari);
            
            // Random payment method - hanya tunai dan e-wallet
            $paymentMethods = ['tunai', 'e-wallet'];
            $paymentMethod = $paymentMethods[array_rand($paymentMethods)];

            $transactions[] = [
                'anggota_id' => $anggota->id,
                'paket_id' => $paket->id,
                'waktu_mulai' => $waktuMulai->format('Y-m-d'),
                'waktu_berakhir' => $waktuBerakhir->format('Y-m-d'),
                'total_harga' => $paket->harga,
                'payment_method' => $paymentMethod,
                'status' => 'lunas',
                'keterangan' => 'Pembayaran membership ' . $paket->nama_paket,
                'created_at' => $waktuMulai,
                'updated_at' => $waktuMulai,
            ];
        }

        // Add some extra historical transactions
        $extraTransactions = 10;
        for ($i = 0; $i < $extraTransactions; $i++) {
            $anggota = $anggotaList->random();
            $paket = $paketList->random();
            $waktuMulai = Carbon::now()->subDays(rand(100, 180));
            $waktuBerakhir = $waktuMulai->copy()->addDays($paket->durasi_hari);
            
            $paymentMethods = ['tunai', 'e-wallet'];
            $paymentMethod = $paymentMethods[array_rand($paymentMethods)];

            $transactions[] = [
                'anggota_id' => $anggota->id,
                'paket_id' => $paket->id,
                'waktu_mulai' => $waktuMulai->format('Y-m-d'),
                'waktu_berakhir' => $waktuBerakhir->format('Y-m-d'),
                'total_harga' => $paket->harga,
                'payment_method' => $paymentMethod,
                'status' => 'lunas',
                'keterangan' => 'Pembayaran membership ' . $paket->nama_paket,
                'created_at' => $waktuMulai,
                'updated_at' => $waktuMulai,
            ];
        }

        // Insert all transactions
        foreach ($transactions as $data) {
            Transaksi::create($data);
        }

        $this->command->info('Transaksi seeded successfully! Total: ' . count($transactions) . ' transactions.');
    }
}