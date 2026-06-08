<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            [
                'kode_item_id' => 1,
                'kode_item' => 'KOI0001',
                'nama_item' => 'Koi Kohaku 20cm',
                'harga_beli' => 100000,
                'harga_jual' => 150000,
                'stok' => 10,
                'stok_minimum' => 2,
                'foto' => null,
                'deskripsi' => 'Ikan koi Kohaku ukuran 20 cm.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_item_id' => 1,
                'kode_item' => 'KOI0002',
                'nama_item' => 'Koi Showa 25cm',
                'harga_beli' => 150000,
                'harga_jual' => 225000,
                'stok' => 8,
                'stok_minimum' => 2,
                'foto' => null,
                'deskripsi' => 'Ikan koi Showa ukuran 25 cm.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_item_id' => 1,
                'kode_item' => 'KOI0003',
                'nama_item' => 'Koi Sanke 30cm',
                'harga_beli' => 250000,
                'harga_jual' => 350000,
                'stok' => 5,
                'stok_minimum' => 1,
                'foto' => null,
                'deskripsi' => 'Ikan koi Sanke ukuran 30 cm.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_item_id' => 2,
                'kode_item' => 'PKN0001',
                'nama_item' => 'Pakan Koi Premium 1kg',
                'harga_beli' => 45000,
                'harga_jual' => 65000,
                'stok' => 20,
                'stok_minimum' => 5,
                'foto' => null,
                'deskripsi' => 'Pakan koi premium kemasan 1 kg.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_item_id' => 2,
                'kode_item' => 'PKN0002',
                'nama_item' => 'Pakan Koi Growth 2kg',
                'harga_beli' => 85000,
                'harga_jual' => 120000,
                'stok' => 15,
                'stok_minimum' => 5,
                'foto' => null,
                'deskripsi' => 'Pakan pertumbuhan koi kemasan 2 kg.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_item_id' => 3,
                'kode_item' => 'ACC0001',
                'nama_item' => 'Jaring Koi',
                'harga_beli' => 25000,
                'harga_jual' => 40000,
                'stok' => 10,
                'stok_minimum' => 2,
                'foto' => null,
                'deskripsi' => 'Jaring untuk menangkap ikan koi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_item_id' => 3,
                'kode_item' => 'ACC0002',
                'nama_item' => 'Aerator Kolam',
                'harga_beli' => 75000,
                'harga_jual' => 110000,
                'stok' => 7,
                'stok_minimum' => 2,
                'foto' => null,
                'deskripsi' => 'Aerator untuk meningkatkan oksigen kolam.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_item_id' => 4,
                'kode_item' => 'OBT0001',
                'nama_item' => 'Vitamin Koi',
                'harga_beli' => 30000,
                'harga_jual' => 50000,
                'stok' => 12,
                'stok_minimum' => 3,
                'foto' => null,
                'deskripsi' => 'Vitamin untuk menjaga kesehatan koi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_item_id' => 4,
                'kode_item' => 'OBT0002',
                'nama_item' => 'Obat Anti Jamur',
                'harga_beli' => 35000,
                'harga_jual' => 55000,
                'stok' => 10,
                'stok_minimum' => 3,
                'foto' => null,
                'deskripsi' => 'Obat untuk mengatasi jamur pada koi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}