<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlatGym;
use Carbon\Carbon;

class AlatGymSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alatData = [
            [
                'nama' => 'Treadmill Pro X500',
                'merek' => 'Life Fitness',
                'kondisi' => 'baik',
                'waktu_pembelian' => Carbon::now()->subMonths(8)->format('Y-m-d'),
            ],
            [
                'nama' => 'Elliptical Trainer E35',
                'merek' => 'Technogym',
                'kondisi' => 'baik',
                'waktu_pembelian' => Carbon::now()->subMonths(7)->format('Y-m-d'),
            ],
            [
                'nama' => 'Stationary Bike B70',
                'merek' => 'Peloton',
                'kondisi' => 'baik',
                'waktu_pembelian' => Carbon::now()->subMonths(6)->format('Y-m-d'),
            ],
            [
                'nama' => 'Rowing Machine R200',
                'merek' => 'Concept2',
                'kondisi' => 'baik',
                'waktu_pembelian' => Carbon::now()->subMonths(10)->format('Y-m-d'),
            ],
            [
                'nama' => 'Chest Press Machine',
                'merek' => 'Hammer Strength',
                'kondisi' => 'baik',
                'waktu_pembelian' => Carbon::now()->subMonths(12)->format('Y-m-d'),
            ],
            [
                'nama' => 'Lat Pulldown Machine',
                'merek' => 'Life Fitness',
                'kondisi' => 'baik',
                'waktu_pembelian' => Carbon::now()->subMonths(11)->format('Y-m-d'),
            ],
            [
                'nama' => 'Leg Press Machine',
                'merek' => 'Technogym',
                'kondisi' => 'baik',
                'waktu_pembelian' => Carbon::now()->subMonths(9)->format('Y-m-d'),
            ],
            [
                'nama' => 'Smith Machine',
                'merek' => 'Matrix',
                'kondisi' => 'baik',
                'waktu_pembelian' => Carbon::now()->subMonths(14)->format('Y-m-d'),
            ],
            [
                'nama' => 'Cable Crossover Machine',
                'merek' => 'Precor',
                'kondisi' => 'rusak_ringan',
                'waktu_pembelian' => Carbon::now()->subMonths(15)->format('Y-m-d'),
            ],
            [
                'nama' => 'Dumbbell Set 2.5-40kg',
                'merek' => 'Jordan',
                'kondisi' => 'baik',
                'waktu_pembelian' => Carbon::now()->subMonths(12)->format('Y-m-d'),
            ],
            [
                'nama' => 'Barbell Set 20kg',
                'merek' => 'Eleiko',
                'kondisi' => 'baik',
                'waktu_pembelian' => Carbon::now()->subMonths(12)->format('Y-m-d'),
            ],
            [
                'nama' => 'Weight Bench Adjustable',
                'merek' => 'Rogue Fitness',
                'kondisi' => 'baik',
                'waktu_pembelian' => Carbon::now()->subMonths(13)->format('Y-m-d'),
            ],
            [
                'nama' => 'Squat Rack Power Cage',
                'merek' => 'Rogue Fitness',
                'kondisi' => 'baik',
                'waktu_pembelian' => Carbon::now()->subMonths(14)->format('Y-m-d'),
            ],
            [
                'nama' => 'Leg Curl Machine',
                'merek' => 'Life Fitness',
                'kondisi' => 'rusak_ringan',
                'waktu_pembelian' => Carbon::now()->subMonths(16)->format('Y-m-d'),
            ],
            [
                'nama' => 'Shoulder Press Machine',
                'merek' => 'Hammer Strength',
                'kondisi' => 'baik',
                'waktu_pembelian' => Carbon::now()->subMonths(10)->format('Y-m-d'),
            ],
            [
                'nama' => 'Ab Crunch Machine',
                'merek' => 'Technogym',
                'kondisi' => 'rusak_berat',
                'waktu_pembelian' => Carbon::now()->subMonths(24)->format('Y-m-d'),
            ],
            [
                'nama' => 'Spin Bike SB900',
                'merek' => 'Schwinn',
                'kondisi' => 'baik',
                'waktu_pembelian' => Carbon::now()->subMonths(8)->format('Y-m-d'),
            ],
            [
                'nama' => 'Kettlebell Set 4-32kg',
                'merek' => 'Kettler',
                'kondisi' => 'baik',
                'waktu_pembelian' => Carbon::now()->subMonths(11)->format('Y-m-d'),
            ],
            [
                'nama' => 'Battle Rope 15m',
                'merek' => 'Titan Fitness',
                'kondisi' => 'baik',
                'waktu_pembelian' => Carbon::now()->subMonths(6)->format('Y-m-d'),
            ],
            [
                'nama' => 'Plyo Box Set',
                'merek' => 'Rogue Fitness',
                'kondisi' => 'baik',
                'waktu_pembelian' => Carbon::now()->subMonths(5)->format('Y-m-d'),
            ],
        ];

        foreach ($alatData as $data) {
            AlatGym::create($data);
        }

        $this->command->info('AlatGym seeded successfully! Total: ' . count($alatData) . ' equipment items.');
        
        $baik = collect($alatData)->where('kondisi', 'baik')->count();
        $rusakRingan = collect($alatData)->where('kondisi', 'rusak_ringan')->count();
        $rusakBerat = collect($alatData)->where('kondisi', 'rusak_berat')->count();
        
        $this->command->info("Kondisi: Baik ({$baik}), Rusak Ringan ({$rusakRingan}), Rusak Berat ({$rusakBerat})");
    }
}