<?php

namespace App\Models;

use App\Models\Transaksi;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';

    public $timestamps = false;
    // tabel kamu tidak punya created_at / updated_at

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'transaksi_id',
        'item_id',
        'nama_item',
        'harga',
        'qty',
        'subtotal',
    ];

    /**
     * Type casting
     */
    protected $casts = [
        'harga' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'qty' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Detail ini milik satu transaksi
     */
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    /**
     * Detail ini mengacu ke satu item
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper (opsional tapi berguna)
    |--------------------------------------------------------------------------
    */

    /**
     * Hitung subtotal otomatis (kalau mau dipakai di service)
     */
    public function calculateSubtotal(): float
    {
        return $this->harga * $this->qty;
    }

    protected static function booted()
    {
        static::saving(function ($model) {
            $model->subtotal = $model->harga * $model->qty;
        });
    }
}