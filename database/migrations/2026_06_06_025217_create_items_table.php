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
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kode_item_id')
                ->constrained('kode_items');

            $table->string('kode_item', 30)->unique();
            $table->string('nama_item', 150);

            $table->decimal('harga_beli', 15, 2);
            $table->decimal('harga_jual', 15, 2);

            $table->integer('stok')->default(0);
            $table->integer('stok_minimum')->default(0);

            $table->string('foto', 255)->nullable();
            $table->text('deskripsi')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};