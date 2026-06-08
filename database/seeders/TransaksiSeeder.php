<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaksi')->insert([
            [
                'nomor_invoice' => 'INV-20260701-0001',
                'user_id' => 1,
                'total_harga' => 215000,
                'bayar' => 250000,
                'kembalian' => 35000,
                'tanggal_transaksi' => '2026-07-01 09:15:00',
                'created_at' => now(),
            ],
            [
                'nomor_invoice' => 'INV-20260701-0002',
                'user_id' => 2,
                'total_harga' => 50000,
                'bayar' => 100000,
                'kembalian' => 50000,
                'tanggal_transaksi' => '2026-07-01 13:20:00',
                'created_at' => now(),
            ],
            [
                'nomor_invoice' => 'INV-20260702-0001',
                'user_id' => 2,
                'total_harga' => 350000,
                'bayar' => 400000,
                'kembalian' => 50000,
                'tanggal_transaksi' => '2026-07-02 10:00:00',
                'created_at' => now(),
            ],
            [
                'nomor_invoice' => 'INV-20260703-0001',
                'user_id' => 3,
                'total_harga' => 120000,
                'bayar' => 150000,
                'kembalian' => 30000,
                'tanggal_transaksi' => '2026-07-03 15:30:00',
                'created_at' => now(),
            ],
            [
                'nomor_invoice' => 'INV-20260704-0001',
                'user_id' => 1,
                'total_harga' => 460000,
                'bayar' => 500000,
                'kembalian' => 40000,
                'tanggal_transaksi' => '2026-07-04 11:45:00',
                'created_at' => now(),
            ],
        ]);
    }
}