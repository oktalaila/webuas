<?php

namespace App\Models;

use App\Models\KodeItem;
use App\Models\DetailTransaksi;
use App\Models\MutasiStok;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'items';

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'kode_item_id',
        'kode_item',
        'nama_item',
        'harga_beli',
        'harga_jual',
        'stok',
        'stok_minimum',
        'foto',
        'deskripsi',
    ];

    /**
     * Type casting
     */
    protected $casts = [
        'harga_beli' => 'decimal:2',
        'harga_jual' => 'decimal:2',
        'stok' => 'integer',
        'stok_minimum' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Item belongs to KodeItem
     */
    public function kodeItem()
    {
        return $this->belongsTo(KodeItem::class, 'kode_item_id');
    }

    /**
     * Item has many DetailTransaksi
     */
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'item_id');
    }

    /**
     * Item has many MutasiStok
     */
    public function mutasiStok()
    {
        return $this->hasMany(MutasiStok::class, 'item_id');
    }
}