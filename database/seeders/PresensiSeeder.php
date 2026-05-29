<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Presensi;
use App\Models\Anggota;
use Carbon\Carbon;

class PresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transaksis = \App\Models\Transaksi::where('status', 'lunas')->get();

        if ($transaksis->isEmpty()) {
            $this->command->warn('Please run TransaksiSeeder first!');
            return;
        }

        $presensiRecords = [];
        $trackedDates = []; // Separate tracking array from data records

        // Create attendance records for valid transactions
        foreach ($transaksis as $transaksi) {
            $trackedDates[$transaksi->id] = [];

            // Random number of visits (5-15 visits per transaction)
            $visitCount = rand(5, 15);

            for ($i = 0; $i < $visitCount; $i++) {
                // Ensure date is within the transaction period
                $start = \Carbon\Carbon::parse($transaksi->waktu_mulai);
                $end = \Carbon\Carbon::parse($transaksi->waktu_berakhir);
                $today = \Carbon\Carbon::now();
                
                // If end date is in the future, we cap the random date to today
                $maxDate = $end->isFuture() ? $today : $end;
                
                if ($start->isAfter($maxDate)) {
                    continue; // Skip if it hasn't started yet relative to max date
                }

                $diffInDays = $start->diffInDays($maxDate);
                
                // Avoid error if diff is 0
                if ($diffInDays == 0) {
                    $randomDays = 0;
                } else {
                    $randomDays = rand(0, $diffInDays);
                }

                $date = $start->copy()->addDays($randomDays);
                
                // Random time between 6 AM and 9 PM
                $hour = rand(6, 21);
                $minute = rand(0, 59);
                $second = rand(0, 59);
                
                $waktuMasuk = $date->setTime($hour, $minute, $second);

                // Avoid duplicate attendance for same transaction on same day
                $dateKey = $waktuMasuk->format('Y-m-d');
                
                if (!in_array($dateKey, $trackedDates[$transaksi->id])) {
                    $presensiRecords[] = [
                        'transaksi_id' => $transaksi->id,
                        'waktu_masuk' => $waktuMasuk->format('Y-m-d H:i:s'),
                        'created_at' => $waktuMasuk,
                        'updated_at' => $waktuMasuk,
                    ];
                    
                    // Track dates for this transaction
                    $trackedDates[$transaksi->id][] = $dateKey;
                }
            }
        }

        // Insert all attendance records
        foreach ($presensiRecords as $data) {
            Presensi::create($data);
        }

        $this->command->info('Presensi seeded successfully! Total: ' . count($presensiRecords) . ' attendance records.');
    }
}