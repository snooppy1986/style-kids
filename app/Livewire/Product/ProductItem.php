<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductItem extends Component
{
    public  $product;
    public string $type = 'product';
    public  $sku;
    public  $colors=[];
    public $count = 1;
    public $sizes = null;
    public $activeSize;

    public function mount()
    {

        $this->sku = $this->product->skus[0];
        $this->sizes = $this->sku->sizes;

        $this->activeSize = [
            'product_id' => $this->product->id,
            'size_id' => $this->sizes->count() ? $this->sizes[0]->size->id : 0,
            'size_value' => $this->sizes->count() ? $this->sizes[0]->size->value : 0
        ];
        $this->getColors($this->product);
    }

    public function getColors($products)
    {
       foreach ($products->skus as $sku){
           $this->colors[$sku->id] = $sku->color;
       }
    }

    public function render()
    {
        /*dump($this->product);*/
        return view('livewire.product.product-item');
    }

    public function changeSku($sku_id)
    {
        $this->sku = $this->product->skus()->where('id', '=', $sku_id)->first();
        $this->sizes = $this->sku->sizes->load('size')->sortBy('size.value');
        /*dd($this->sizes);*/
        $this->activeSize = [
            'product_id' => $this->product->id,
            'size_id' => $this->sizes[0]->size->id,
            'size_value' => $this->sizes[0]->size->value
        ];
    }

    public function changeSize($product_id, $size_id)
    {

        $this->activeSize = [
            'product_id' => $product_id,
            'size_id' => $size_id,
            'size_value' => Size::query()->where('id', '=', $size_id)->first()->value
        ];
        /*dd($product_id, $size_id);*/
    }
}
