<?php

namespace App\Livewire\Category;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithPagination;
use phpDocumentor\Reflection\Types\Collection;
use function League\Uri\UriTemplate\first;

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
            ->withCount('products')
            ->whereNotNull('parent_id')
            ->get();
        /*dd($this->categories);*/
        $this->category = Category::query()
            ->where('id', $this->id)
            ->first();

        $subcategoryIds = [];
        $this->getSubCategoryIds($this->categories, $subcategoryIds, $this->id);
        $products = Product::query()
            ->where('active', 1)
            ->with(['skus' => function($query){
                $this->maxPrice = $query->max('price');
                $this->minPrice = $query->min('price');
            }])
            ->whereHas('categories', function ($query) use($subcategoryIds){
                $query->whereIn('category_id', $subcategoryIds);
            })

            ->paginate(12);

        /*$this->category = Category::query()
            ->with(['recursiveProducts' => function($query){
                if($query->count()){
                    $this->minPrice = $query->with(['skus' => function($query){
                        dd($query->min('price'));
                        $this->minPrice = $query->min('price') ? intval($query->min('price')) : 0;
                        $this->maxPrice = $query->max('price') ? intval($query->max('price')) : 1;
                    }]);
                }

            }])
            ->find($this->id);*/

        /*dd($this->products);*/
        /*$subCategories = Category::query()
            ->with('products')
            ->whereIn('id', $subcategoryIds)
            ->get();*/
        /*dd($subCategories);*/
        /*$subCategories->products()->where('active', 1)->paginate(12);*/
        /*$products = new \Illuminate\Support\Collection();

        foreach ($subCategories as $category){
            if($category->count()){
                $products = $products->merge($category)->sortByDesc('created_at');
            }

        }
        $this->products = $products->paginate(12);*/
        /*dd($this->id, $subcategoryIds, $subCategories, $this->products);*/
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
        /*dump($column_name);*/
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
        $this->categories = Category::query()
            ->withCount('products')
            ->whereNotNull('parent_id')
            ->get();
        /*dump($this->categories);*/
        $subcategoryIds = [];
        $this->getSubCategoryIds($this->categories, $subcategoryIds, $this->id);
        /*dump($subcategoryIds);*/

        /*dd($products);*/
        if($this->orderColumn == 'created_at' || $this->orderColumn == 'title_ru' || $this->orderColumn == 'title_ua'){

            $products = Product::query()
                ->where('active', 1)

                ->whereHas('categories', function ($query) use($subcategoryIds){
                    $query->whereIn('category_id', $subcategoryIds);
                })

                ->whereHas('skus', function ($query){
                    $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
                })
                ->whereHas('skus', function ($query){
                    if($this->orderColumn == 'price'){
                        $query->sortBy('price', $this->sortOrder);
                    }
                })

                ->orderBy($this->orderColumn, $this->sortOrder)


                ->paginate(12);


            /*dump($this->orderColumn);*/
            /*$products = Product::query()
                ->where('active', 1)
                ->with([
                    'categories' => function ($query) use ($subcategoryIds){
                        $query->whereIn('category_id', $subcategoryIds);
                    },
                    'skus' =>  function ($query){
                        $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
                    }
                ])
                ->orderBy($this->orderColumn, $this->sortOrder)
                ->paginate(12);*/
            /*$this->category = Category::query()
                ->where('parent_id', $this->id)
                ->first();*/
           /* $products = Product::query()
                ->where('active', 1)
                ->whereHas('categories', function ($query) use ($subcategoryIds){
                    $query->whereIn('category_id', $subcategoryIds);
                })
                ->whereHas('skus', function ($query){
                    $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
                })
                ->orderBy($this->orderColumn, $this->sortOrder)
                ->paginate(12);*/
            /*$products = $this->category
                ->recursiveProducts()
                ->where('active', '=', 1)
                ->with(['skus'=>function($query){
                    $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
                }])
                ->whereHas('skus', function ($query){
                    $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
                })
                ->orderBy($this->orderColumn, $this->sortOrder)
                ->paginate(12);*/
        }elseif($this->orderColumn == 'price'){
            /*dump('price');*/
            $products = Product::query()
                ->where('active', 1)
                ->whereHas('categories', function ($query) use($subcategoryIds){
                    $query->whereIn('category_id', $subcategoryIds);
                })
                ->whereHas('skus', function ($query){
                    $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
                })
                ->select(['products.*', 'skus.price as sku_price'])
                ->join('skus', 'products.id', '=', 'skus.product_id')
                ->orderBy('skus.price', $this->sortOrder)
                ->paginate(12);
            /*$products = Product::query()
                ->where('active', 1)
                ->with([
                    'categories' => function ($query) use ($subcategoryIds){
                        $query->whereIn('category_id', $subcategoryIds);
                    },
                    'skus' =>  function ($query){
                        $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
                    }
                ])*/
                /*->whereHas('skus', function ($query){
                    $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
                })*/
                /*->select(['products.*', 'skus.price as sku_price'])
                ->join('skus', 'products.id', '=', 'skus.product_id')
                ->orderBy('skus.price', $this->sortOrder)
                ->paginate(12);*/
            /*dump($this->orderColumn, $this->minPrice, $this->maxPrice);
            $products = Product::query()
                ->whereHas('categories', function ($query) use ($subcategoryIds){
                    $query->whereIn('category_id', $subcategoryIds);
                })
                ->whereHas('skus', function ($query){
                    $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
                })
                ->select(['products.*', 'skus.price as sku_price'])
                ->join('skus', 'products.id', '=', 'skus.product_id')
                ->orderBy('skus.price', $this->sortOrder)
                ->paginate(12);*/
            /*$products = $this->category
                ->recursiveProducts()
                ->where('active', '=', 1)
                ->whereHas('skus', function ($query){
                    $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
                })
                ->with(['skus'=>function($query){
                    $query->orderBy('price', $this->sortOrder);
                }])
                ->select(['products.*', 'skus.price as sku_price'])
                ->join('skus', 'products.id', '=', 'skus.product_id')
                ->orderBy('skus.price', $this->sortOrder)
                ->paginate(12);*/
        }
        if($this->category == 'hi'){
            if($this->orderColumn == 'created_at' || $this->orderColumn == 'title_ru' || $this->orderColumn == 'title_ua'){
                /*$this->category = Category::query()
                    ->where('parent_id', $this->id)
                    ->first();*/
                $subcategoryIds = [];
                $this->getSubCategoryIds($this->categories, $subcategoryIds, $this->id);
                $products = Product::query()
                    ->whereHas('categories', function ($query) use ($subcategoryIds){
                        $query->whereIn('category_id', $subcategoryIds);
                    })
                    ->orderBy('created_at')
                    ->paginate(12);
                /*$products = $this->category
                    ->recursiveProducts()
                    ->where('active', '=', 1)
                    ->with(['skus'=>function($query){
                        $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
                    }])
                    ->whereHas('skus', function ($query){
                        $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
                    })
                    ->orderBy($this->orderColumn, $this->sortOrder)
                    ->paginate(12);*/
            }elseif($this->orderColumn == 'hi2'){
                $subcategoryIds = [];
                $this->getSubCategoryIds($this->categories, $subcategoryIds, $this->id);
                $products = Product::query()
                    ->whereHas('categories', function ($query) use ($subcategoryIds){
                        $query->whereIn('category_id', $subcategoryIds);
                    })
                    ->orderBy('created_at')
                    ->paginate(12);
                /*$products = $this->category
                    ->recursiveProducts()
                    ->where('active', '=', 1)
                    ->whereHas('skus', function ($query){
                        $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
                    })
                    ->with(['skus'=>function($query){
                        $query->orderBy('price', $this->sortOrder);
                    }])
                    ->select(['products.*', 'skus.price as sku_price'])
                    ->join('skus', 'products.id', '=', 'skus.product_id')
                    ->orderBy('skus.price', $this->sortOrder)
                    ->paginate(12);*/
            }
        }else{
            $products = $products;
        }

        return view('livewire.category.show', [
            'products' => $products
        ]);
    }


    public function getSubCategoryIds($categories, &$children, $parent_id = null)
    {
        $children[] = $parent_id;
        $subcategories = $categories->filter(function ($item) use ($parent_id){
            return $item->parent_id == $parent_id;
        });

        foreach ($subcategories as $subcategory){
            $children[] = $subcategory->id;

            $this->getSubCategoryIds($categories, $children, $subcategory->id);
        }

    }
}
