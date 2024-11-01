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
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
            'saldo' => 0,
            'pendapatan' => 0,
            'role' => 'admin',
        ]);
        User::factory()->create([
            'name' => 'uhuy',
            'email' => 'kar@kar.com',
            'password' => Hash::make('karyawan123'),
            'email_verified_at' => now(),
            'saldo' => 0,
            'pendapatan' => 0,
            'role' => 'karyawan',
        ]);
        User::factory()->create([
            'name' => 'ling',
            'email' => 'ling@ling.com',
            'password' => Hash::make('karyawan123'),
            'email_verified_at' => now(),
            'saldo' => 0,
            'pendapatan' => 0,
            'role' => 'karyawan',
        ]);

    }
}
