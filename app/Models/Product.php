<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $thumbnail
 * @property float $price
 * @property float|null $discount_price
 * @property string $body
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\ProductCharacteristics|null $characteristics
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductColor> $colors
 * @property-read int|null $colors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductSize> $sizes
 * @property-read int|null $sizes_count
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDiscountPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'title_ru',
        'title_ua',
        'slug_ru',
        'slug_ua',
        'thumbnail',
        'body_ru',
        'body_ua',
        'active',
        'type',
        'canonical_url_ru',
        'canonical_url_ua',
        'seo_title_ru',
        'seo_title_ua',
        'keywords_ru',
        'keywords_ua',
        'description_ru',
        'description_ua'
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function productCharacteristics(): HasMany
    {
        return $this->hasMany(ProductCharacteristics::class);
    }

   /* public function colors(): HasMany
    {
        return $this->hasMany(ProductColor::class);
    }

    public function sizes(): HasMany
    {
        return $this->hasMany(ProductSize::class);
    }*/

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)
            ->where('active', '=', 1)
            ->orderByDesc('created_at');
    }

    public function additionalInformation(): HasOne
    {
        return $this->hasOne(AdditionalProductInformation::class);
    }

    public function productGallery(): HasMany
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function skus(): HasMany
    {
        return $this->hasMany(Sku::class);
    }

    public function first_skus()
    {
        return $this->hasOne(Sku::class);
    }

    public function shortTitle(): string
    {
        return Str::words(session()->get('locale') == 'ua' ? $this->title_ua : $this->title_ru, 12);
    }

    public function shortBody(): string
    {
        return Str::words(session()->get('locale') == 'ua' ? $this->body_ua : $this->body_ru, 60);
    }

    public function getThumbnail()
    {
        if(str_starts_with($this->thumbnail, 'http')){
            return $this->thumbnail;
        }

        return asset('storage/'.$this->thumbnail);
    }
}
