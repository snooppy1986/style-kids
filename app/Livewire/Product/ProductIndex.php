<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductIndex extends Component
{
    use WithPagination;

    public $page_type;
    public $categories;
    public $price_max = 10000;
    public $price_min = 0;
    public $orderColumn='created_at';
    public $sortOrder='asc';
    public $listeners = ['priceRange'];

    public function mount()
    {
        /*$this->products = Product::where('active', 1)->paginate(15);*/
        $this->categories = Category::query()
            ->withCount('recursiveProducts')
            ->whereNotNull('parent_id')
            ->get();
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function priceRange($range_price)
    {
        $this->price_min = $range_price[0];
        $this->price_max = $range_price[1];
    }
    public function sort($column_name)
    {
        $order_params = explode(' ', $column_name);
        $this->orderColumn = $order_params[0];
        $this->sortOrder = $order_params[1];
    }

    public function paginationView()
    {
        return 'livewire.pagination.custom-pagination-links-view';
    }

    public function render()
    {
        if($this->page_type){
            $products = Product::query()
                ->whereHas('additionalInformation', function ($query){
                    $query->where($this->page_type, 1);
                })
                ->where('active', 1)
                ->whereBetween('price', [$this->price_min, $this->price_max])
                ->orderBy($this->orderColumn, $this->sortOrder)
                ->paginate(15);
        }else{
            $products = Product::query()
                ->where('active', 1)
                ->whereBetween('price', [$this->price_min, $this->price_max])
                ->orderBy($this->orderColumn, $this->sortOrder)
                ->paginate(15);
        }


        return view('livewire.product.product-index', compact('products'));
    }
}
