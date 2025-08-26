<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

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
        return $this->model->whereHas('skus', function ($query) {
            $query->where('new', 1);
        })
        ->with(['skus', 'comments'])
        ->where('active', '=', 1)
        ->limit($limit)
        ->get();
    }

    public function getHitProducts(int $limit = 12): Collection
    {
        return $this->model->whereHas('skus', function ($query) {
            $query->where('hit', 1);
        })
        ->with(['skus', 'comments'])
        ->where('active', '=', 1)
        ->limit($limit)
        ->get();
    }
}
