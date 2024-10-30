<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use mysql_xdevapi\Collection;
use PhpParser\Node\Expr\Array_;
use RecursiveRelationships\Traits\HasRecursiveRelationships;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $parent_id
 * @property string|null $thumbnail
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Category> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\CategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    use HasFactory;
    use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
    protected $fillable = [
        'group_number',
        'title_ru',
        'title_ua',
        'slug',
        'parent_id',
        'thumbnail',
        'status',
        'canonical_url',
        'seo_title',
        'keywords',
        'description'
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function children(): hasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function allChildren(): hasMany
    {
        return $this->children()->with('allChildren', 'products');
    }
    public function recursiveProducts()
    {
        return $this->belongsToManyOfDescendantsAndSelf(Product::class);
    }
    public function shortTitle(): string
    {
        return Str::words(session()->get('locale') == 'ua' || session()->get('locale') == null ? $this->title_ua : $this->title_ru, 2);
    }
    public function getThumbnail()
    {
        if(str_starts_with($this->thumbnail, 'http')){
            return $this->thumbnail;
        }
        return 'storage/'.$this->thumbnail;
    }
}
