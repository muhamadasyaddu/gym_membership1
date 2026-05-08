<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin user
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Create Staff users
        User::create([
            'nama' => 'Adie Kurniawan',
            'email' => 'adie@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'staff',
        ]);

        User::create([
            'nama' => 'Muhammad Asyaddu',
            'email' => 'asyaddu@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'staff',
        ]);

        $this->command->info('Users seeded successfully!');
        $this->command->info('Admin: admin@gmail.com / password123');
        $this->command->info('Staff: adie@gmail.com / password123');
        $this->command->info('Staff: asyaddu@gmail.com / password123');
    }
}
