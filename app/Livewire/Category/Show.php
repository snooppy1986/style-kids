<?php

namespace App\Livewire\Category;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sku;
use Livewire\Component;
use Livewire\WithPagination;
use phpDocumentor\Reflection\Types\Collection;

class Show extends Component
{
    use WithPagination;
    public int $id;
    public $categories;
    public $category;
    public array $size = [];
    public int $maxPrice = 1800;
    public $minPrice = 0;
    protected string $paginationTheme = 'bootstrap';
    public string $orderColumn='created_at';
    public string $sortOrder='asc';
    public $listeners = ['priceRange'];

    public function mount()
    {
        $this->categories = Category::query()
            ->withCount('recursiveProducts')
            ->whereNotNull('parent_id')
            ->get();

        $this->category = Category::query()
            ->with(['recursiveProducts' => function($query){
                if($query->count()){
                    $this->minPrice = $query->with(['skus' => function($query){
                        /*dd($query->min('price'));*/
                        $this->minPrice = $query->min('price') ? intval($query->min('price')) : 0;
                        $this->maxPrice = $query->max('price') ? intval($query->max('price')) : 1;
                    }]);
                }

            }])
            ->find($this->id);
    }

    public function priceRange($range_price)
    {
        $this->minPrice= $range_price[0];
        $this->maxPrice = $range_price[1];
        $this->resetPage();
        $this->dispatch('scroll');
    }

    public function sort($column_name)
    {
        $order_params = explode(' ', $column_name);
        $this->orderColumn = $order_params[0];
        $this->sortOrder = $order_params[1];
        $this->resetPage();
    }
    public function paginationView()
    {
        return 'livewire.pagination.custom-pagination-links-view';
    }
    public function render()
    {
        /*dd($this->category->recursiveProducts);*/
        if($this->category->recursiveProducts->count()){

            if($this->orderColumn == 'created_at' || $this->orderColumn == 'title_ru' || $this->orderColumn == 'title_ua'){

                $products = $this->category
                    ->recursiveProducts()
                    ->where('active', '=', 1)
                    ->with(['skus'=>function($query){
                        $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
                    }])
                    ->whereHas('skus', function ($query){
                        $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
                    })
                    ->orderBy($this->orderColumn, $this->sortOrder)
                    ->paginate(12);

            }else{
                $products = $this->category
                    ->recursiveProducts()
                    ->where('active', '=', 1)
                    ->with(['skus'=>function($query){
                        $query->orderBy('price', $this->sortOrder);
                    }])
                    ->select(['products.*', 'skus.price as sku_price'])
                    ->join('skus', 'products.id', '=', 'skus.product_id')
                    ->orderBy('skus.price', $this->sortOrder)
                    ->paginate(12);

            }
        }else{
            $products = [];
        }
        /*dd($products);*/
        return view('livewire.category.show', [
            'products' => $products
        ]);
    }
}
