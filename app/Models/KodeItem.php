<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KodeItem extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Table name (optional karena sudah sesuai plural Laravel)
     */
    protected $table = 'kode_items';

    /**
     * Mass assignable
     */
    protected $fillable = [
        'kode_prefix',
        'nama_kode',
    ];

    /**
     * Cast attributes
     */
    protected $casts = [
        
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    /**
     * 1 KodeItem -> banyak Items
     */
    public function items()
    {
        return $this->hasMany(Item::class, 'kode_item_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES (opsional tapi berguna)
    |--------------------------------------------------------------------------
    */

    public function scopeByPrefix($query, string $prefix)
    {
        return $query->where('kode_prefix', $prefix);
    }
}