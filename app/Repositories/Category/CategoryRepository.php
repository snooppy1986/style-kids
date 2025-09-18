<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CategoryRepository extends BaseRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected Category $category)
    {
        parent::__construct($this->category);
    }

    public function getAllCategories(): Collection
    {
        return Cache::remember('categories', 3600, function()  {
            return $this->model->all();
        });        
    }

    public function getParentCategories(): Collection
    {
        return Cache::remember('parent_categories', 3600, function()  {
            return $this->model
                ->with('descendants', 'products')
                ->whereNull('parent_id')
                ->get();;
        });
    }
}
