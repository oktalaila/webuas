<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'nama' => 'Administrator',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        User::create([
            'username' => 'pegawai1',
            'nama' => 'Pegawai Satu',
            'password' => Hash::make('password'),
            'role' => 'pegawai',
            'is_active' => true,
        ]);

        User::create([
            'username' => 'pegawai2',
            'nama' => 'Pegawai Dua',
            'password' => Hash::make('password'),
            'role' => 'pegawai',
            'is_active' => true,
        ]);
    }
}