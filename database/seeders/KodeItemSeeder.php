<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KodeItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kode_items')->insert([
            [
                'kode_prefix' => 'KOI',
                'nama_kode' => 'Ikan Koi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_prefix' => 'PKN',
                'nama_kode' => 'Pakan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_prefix' => 'ACC',
                'nama_kode' => 'Aksesoris',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_prefix' => 'OBT',
                'nama_kode' => 'Obat dan Vitamin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}