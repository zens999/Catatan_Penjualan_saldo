<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'zaenal_m',
            'email' => 'zm527332@gmail.com',
            'password' => Hash::make('zaenal99'),
            'email_verified_at' => now(),
            'saldo' => 0,
            'pendapatan' => 0,
            'role' => 'admin',
        ]);


    }
}
