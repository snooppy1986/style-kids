<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ProductRepository extends BaseRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected Product $product)
    {
        parent::__construct($this->product);
    }

    public function getNewProducts(int $limit = 8): Collection
    {
        return Cache::remember('new_products', 3600, function() use($limit)  {
            return $this->model->whereHas('skus', function ($query)  {
                            $query->where('new', 1);
                        })
                    ->with(['skus', 'comments'])
                    ->where('active', '=', 1)
                    ->limit($limit)
                    ->get();
        });

        
    }

    public function getHitProducts(int $limit = 12): Collection
    {
        return Cache::remember('hit_products', 3600, function() use($limit){
            return $this->model->whereHas('skus', function ($query) {
                        $query->where('hit', 1);
                    })
                    ->with(['skus', 'comments'])
                    ->where('active', '=', 1)
                    ->limit($limit)
                    ->get();
                    });
        
    }

    public function getProductBySlug(string $slug): Model
    {
        return Cache::remember("product_{$slug}", 3600, function() use($slug) { 
             return $this->model
                ->with(['comments', 'skus'])
                ->where('active', 1)
                ->where('slug_ru', $slug)
                ->orWhere('slug_ua', $slug)
                ->first();
        });
      
    }

   
}
