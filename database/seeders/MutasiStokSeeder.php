<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MutasiStokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mutasi_stok')->insert([

            // Pembelian stok awal Koi Kohaku
            [
                'item_id' => 1,
                'user_id' => 1,
                'jenis_mutasi' => 'masuk',
                'alasan_mutasi' => 'pembelian',
                'jumlah' => 10,
                'stok_sebelum' => 0,
                'stok_sesudah' => 10,
                'tanggal_mutasi' => '2026-06-25 08:00:00',
                'keterangan' => 'Pembelian stok awal.',
                'created_at' => now(),
            ],

            // Penjualan Koi Kohaku
            [
                'item_id' => 1,
                'user_id' => 1,
                'jenis_mutasi' => 'keluar',
                'alasan_mutasi' => 'penjualan',
                'jumlah' => 1,
                'stok_sebelum' => 10,
                'stok_sesudah' => 9,
                'tanggal_mutasi' => '2026-07-01 09:15:00',
                'keterangan' => 'Penjualan melalui kasir.',
                'created_at' => now(),
            ],

            // Pembelian stok pakan
            [
                'item_id' => 4,
                'user_id' => 1,
                'jenis_mutasi' => 'masuk',
                'alasan_mutasi' => 'pembelian',
                'jumlah' => 20,
                'stok_sebelum' => 0,
                'stok_sesudah' => 20,
                'tanggal_mutasi' => '2026-06-25 09:00:00',
                'keterangan' => 'Pembelian stok awal pakan.',
                'created_at' => now(),
            ],

            // Penjualan pakan
            [
                'item_id' => 4,
                'user_id' => 2,
                'jenis_mutasi' => 'keluar',
                'alasan_mutasi' => 'penjualan',
                'jumlah' => 1,
                'stok_sebelum' => 20,
                'stok_sesudah' => 19,
                'tanggal_mutasi' => '2026-07-01 09:15:00',
                'keterangan' => 'Penjualan melalui kasir.',
                'created_at' => now(),
            ],

            // Koi sakit
            [
                'item_id' => 2,
                'user_id' => 3,
                'jenis_mutasi' => 'keluar',
                'alasan_mutasi' => 'sakit',
                'jumlah' => 1,
                'stok_sebelum' => 8,
                'stok_sesudah' => 7,
                'tanggal_mutasi' => '2026-07-02 14:00:00',
                'keterangan' => 'Dipindahkan ke kolam karantina.',
                'created_at' => now(),
            ],

            // Koi sembuh dan kembali ke stok
            [
                'item_id' => 2,
                'user_id' => 1,
                'jenis_mutasi' => 'masuk',
                'alasan_mutasi' => 'lainnya',
                'jumlah' => 1,
                'stok_sebelum' => 7,
                'stok_sesudah' => 8,
                'tanggal_mutasi' => '2026-07-05 09:00:00',
                'keterangan' => 'Koi sembuh dan kembali dijual.',
                'created_at' => now(),
            ],

            // Ikan mati
            [
                'item_id' => 3,
                'user_id' => 2,
                'jenis_mutasi' => 'keluar',
                'alasan_mutasi' => 'mati',
                'jumlah' => 1,
                'stok_sebelum' => 5,
                'stok_sesudah' => 4,
                'tanggal_mutasi' => '2026-07-03 08:30:00',
                'keterangan' => 'Ikan mati karena stres pengiriman.',
                'created_at' => now(),
            ],

            // Barang rusak
            [
                'item_id' => 7,
                'user_id' => 2,
                'jenis_mutasi' => 'keluar',
                'alasan_mutasi' => 'rusak',
                'jumlah' => 1,
                'stok_sebelum' => 7,
                'stok_sesudah' => 6,
                'tanggal_mutasi' => '2026-07-04 10:00:00',
                'keterangan' => 'Aerator rusak saat penyimpanan.',
                'created_at' => now(),
            ],

            // Retur supplier
            [
                'item_id' => 9,
                'user_id' => 1,
                'jenis_mutasi' => 'keluar',
                'alasan_mutasi' => 'retur',
                'jumlah' => 2,
                'stok_sebelum' => 10,
                'stok_sesudah' => 8,
                'tanggal_mutasi' => '2026-07-05 13:00:00',
                'keterangan' => 'Kemasan obat rusak.',
                'created_at' => now(),
            ],

            // Penyesuaian stok
            [
                'item_id' => 8,
                'user_id' => 1,
                'jenis_mutasi' => 'penyesuaian',
                'alasan_mutasi' => 'lainnya',
                'jumlah' => 2,
                'stok_sebelum' => 10,
                'stok_sesudah' => 12,
                'tanggal_mutasi' => '2026-07-06 08:00:00',
                'keterangan' => 'Koreksi hasil stock opname.',
                'created_at' => now(),
            ],
        ]);
    }
}