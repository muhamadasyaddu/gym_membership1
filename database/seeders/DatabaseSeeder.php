<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('Starting database seeding...');
        $this->command->info('=========================');

        // 1. Seed Users first (Admin & Staff accounts)
        $this->call(UserSeeder::class);

        // 2. Seed Paket Gym (Membership packages)
        $this->call(PaketGymSeeder::class);

        // 3. Seed Anggota (Members)
        $this->call(AnggotaSeeder::class);

        // 4. Seed Transaksi (Transactions) - requires Anggota & PaketGym
        $this->call(TransaksiSeeder::class);

        // 5. Seed Presensi (Attendance) - requires Anggota
        $this->call(PresensiSeeder::class);

        // 6. Seed Alat Gym (Equipment)
        $this->call(AlatGymSeeder::class);

        $this->command->info('=========================');
        $this->command->info('Database seeding completed successfully!');
        $this->command->newLine();
        $this->command->info('Login credentials:');
        $this->command->info('- Admin: admin@gmail.com / password123');
        $this->command->info('- Staff: adie@gmail.com / password123');
        $this->command->info('- Staff: asyaddu@gmail.com / password123');
    }
}