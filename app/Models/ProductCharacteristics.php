<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductCharacteristics
 *
 * @property int $id
 * @property int $product_id
 * @property string|null $country
 * @property string|null $age_group
 * @property string|null $gender
 * @property string|null $material_type
 * @property string|null $season
 * @property string|null $state
 * @property string|null $equipment
 * @property string|null $composition
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCharacteristics newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCharacteristics newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCharacteristics query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCharacteristics whereAgeGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCharacteristics whereComposition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCharacteristics whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCharacteristics whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCharacteristics whereEquipment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCharacteristics whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCharacteristics whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCharacteristics whereMaterialType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCharacteristics whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCharacteristics whereSeason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCharacteristics whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCharacteristics whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductCharacteristics extends Model
{
    use HasFactory;

    protected $fillable = [
        "title_ru",
        "unit",
        "value_ru",
        "value_ua",
    ];
}
