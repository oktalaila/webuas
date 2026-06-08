<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_transaksi')->insert([

            // INV-20260701-0001
            [
                'transaksi_id' => 1,
                'item_id' => 1,
                'nama_item' => 'Koi Kohaku 20cm',
                'harga' => 150000,
                'qty' => 1,
                'subtotal' => 150000,
            ],
            [
                'transaksi_id' => 1,
                'item_id' => 4,
                'nama_item' => 'Pakan Koi Premium 1kg',
                'harga' => 65000,
                'qty' => 1,
                'subtotal' => 65000,
            ],

            // INV-20260701-0002
            [
                'transaksi_id' => 2,
                'item_id' => 8,
                'nama_item' => 'Vitamin Koi',
                'harga' => 50000,
                'qty' => 1,
                'subtotal' => 50000,
            ],

            // INV-20260702-0001
            [
                'transaksi_id' => 3,
                'item_id' => 3,
                'nama_item' => 'Koi Sanke 30cm',
                'harga' => 350000,
                'qty' => 1,
                'subtotal' => 350000,
            ],

            // INV-20260703-0001
            [
                'transaksi_id' => 4,
                'item_id' => 5,
                'nama_item' => 'Pakan Koi Growth 2kg',
                'harga' => 120000,
                'qty' => 1,
                'subtotal' => 120000,
            ],

            // INV-20260704-0001
            [
                'transaksi_id' => 5,
                'item_id' => 2,
                'nama_item' => 'Koi Showa 25cm',
                'harga' => 225000,
                'qty' => 2,
                'subtotal' => 450000,
            ],
            [
                'transaksi_id' => 5,
                'item_id' => 8,
                'nama_item' => 'Vitamin Koi',
                'harga' => 50000,
                'qty' => 1,
                'subtotal' => 50000,
            ],
            [
                'transaksi_id' => 5,
                'item_id' => 6,
                'nama_item' => 'Jaring Koi',
                'harga' => 40000,
                'qty' => 1,
                'subtotal' => 40000,
            ],
        ]);
    }
}