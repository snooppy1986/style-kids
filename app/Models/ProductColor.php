<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductColor
 *
 * @property int $id
 * @property int $product_id
 * @property string $title
 * @property string|null $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductColor extends Model
{
    use HasFactory;

    protected $fillable = ['color'];
}
