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
        $anggotaAktif = Anggota::where('status', 'aktif')->get();

        if ($anggotaAktif->isEmpty()) {
            $this->command->warn('Please run AnggotaSeeder first!');
            return;
        }

        $presensiRecords = [];
        $trackedDates = []; // Separate tracking array from data records

        // Create attendance records for active members
        foreach ($anggotaAktif as $anggota) {
            $trackedDates[$anggota->id] = [];

            // Random number of visits (10-30 visits)
            $visitCount = rand(10, 30);

            for ($i = 0; $i < $visitCount; $i++) {
                // Random date in last 60 days
                $date = Carbon::now()->subDays(rand(1, 60));
                
                // Random time between 6 AM and 9 PM
                $hour = rand(6, 21);
                $minute = rand(0, 59);
                $second = rand(0, 59);
                
                $waktuMasuk = $date->setTime($hour, $minute, $second);

                // Avoid duplicate attendance for same member on same day
                $dateKey = $waktuMasuk->format('Y-m-d');
                
                if (!in_array($dateKey, $trackedDates[$anggota->id])) {
                    $presensiRecords[] = [
                        'anggota_id' => $anggota->id,
                        'waktu_masuk' => $waktuMasuk->format('Y-m-d H:i:s'),
                        'created_at' => $waktuMasuk,
                        'updated_at' => $waktuMasuk,
                    ];
                    
                    // Track dates for this member in separate array
                    $trackedDates[$anggota->id][] = $dateKey;
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