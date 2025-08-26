<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sku_id',
        'qty',
        'unit_price',
        'size',
        'color'
    ];

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function sku(): HasOne
    {
        return $this->hasOne(Sku::class, 'id', 'sku_id');
    }

    public function sizes(): HasOne
    {
        return $this->hasOne(Size::class, 'value', 'size');
    }
}
