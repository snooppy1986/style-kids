<?php

namespace App\Livewire\Search;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class SearchIndex extends Component
{
    use WithPagination;
    public $search;
    public $category;

    public function paginationView()
    {
        return 'livewire.pagination.custom-pagination-links-view';
    }

    public function render()
    {
        if(!$this->category){
            $products = Product::query()
                ->where('title_ru', 'like', "%$this->search%")
                ->orWhere('title_ua', 'like', "%$this->search%")
                ->paginate(16);
        }else{
            $products = Category::find($this->category)
                ->recursiveProducts()
                ->where('title_ru', 'like', "%$this->search%")
                ->orWhere('title_ua', 'like', "%$this->search%")
                ->paginate(16);

        }

        return view('livewire.search.search-index', compact('products'));
    }
}
