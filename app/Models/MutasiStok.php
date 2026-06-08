<?php

namespace App\Models;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiStok extends Model
{
    use HasFactory;

    protected $table = 'mutasi_stok';

    public const UPDATED_AT = null;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'item_id',
        'user_id',
        'jenis_mutasi',
        'alasan_mutasi',
        'jumlah',
        'stok_sebelum',
        'stok_sesudah',
        'tanggal_mutasi',
        'keterangan',
        'created_at',
    ];

    /**
     * Type casting
     */
    protected $casts = [
        'jumlah' => 'integer',
        'stok_sebelum' => 'integer',
        'stok_sesudah' => 'integer',
        'tanggal_mutasi' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Mutasi dilakukan pada satu item
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Mutasi dilakukan oleh user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Cek apakah mutasi menambah stok
     */
    public function isMasuk(): bool
    {
        return $this->jenis_mutasi === 'masuk';
    }

    /**
     * Cek apakah mutasi mengurangi stok
     */
    public function isKeluar(): bool
    {
        return $this->jenis_mutasi === 'keluar';
    }

    /**
     * Label mutasi lebih readable
     */
    public function getLabelAttribute(): string
    {
        return ucfirst($this->jenis_mutasi) . ' - ' . ucfirst($this->alasan_mutasi);
    }
}