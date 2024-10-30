<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SizeSku extends Model
{
    use HasFactory;

    protected $fillable = [
        'size_id',
        'sku_id',
        'count'
    ];

    public function size(): HasOne
    {
        return $this->hasOne(Size::class, 'id', 'size_id');
    }
}
