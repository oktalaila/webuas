<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mutasi_stok', function (Blueprint $table) {
    $table->id();

    $table->foreignId('item_id')
        ->constrained('items');

    $table->foreignId('user_id')
        ->constrained('users');

    $table->enum('jenis_mutasi', [
        'masuk',
        'keluar',
        'penyesuaian',
    ]);

    $table->enum('alasan_mutasi', [
        'pembelian',
        'penjualan',
        'mati',
        'sakit',
        'rusak',
        'hilang',
        'retur',
        'lainnya',
    ]);

    $table->unsignedInteger('jumlah');

    $table->unsignedInteger('stok_sebelum');
    $table->unsignedInteger('stok_sesudah');

    $table->dateTime('tanggal_mutasi')
        ->useCurrent();

    $table->text('keterangan')->nullable();

    $table->timestamp('created_at')
        ->useCurrent();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi_stok');
    }
};
