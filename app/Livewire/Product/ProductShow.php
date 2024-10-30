<?php

namespace App\Livewire\Product;

use App\Models\Size;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\Title;

/*#[Title('Test Title')]*/
class ProductShow extends Component
{
    public $product;
    public object $colors;
    public string $color;
    public $product_options = [];
    public $similar_products;
    public $sku;
    public object $sizes;
    /*public $size_id;*/
    public $opacity = false;
    public $key = 1;
    public $activeSize;
    protected $listeners = [
        'buyProduct',
        'actionBuy'=>'buyProduct'
    ];
    public function mount()
    {
        $this->count = 1;
        $this->getSku($this->product, $this->color);
        $this->getSizes();
        $this->activeSize = [
            'product_id' => $this->product->id,
            'size_id' => $this->sku->sizes[0]->size->id,
            'size_value' => $this->sku->sizes[0]->size->value
        ];
    }
    public function rendered()
    {
        $this->dispatch('contentChanged');
    }

    public function getSizes($size_id=null)
    {
        if ($size_id){
           /* $this->size_id = $size_id;*/
            $this->dispatch('getSize', $size_id);
        }

    }

    public function getSku($product, $color)
    {
        if($color){
            $this->sku = $product->skus()
                ->where('color', '=', $color)
                ->first();
            /*$sizesIds = $this->sku->sizes->pluck('size_id');*/
            $this->sizes = $this->sku->sizes->load('size')->sortBy('size.value');

        }else{
            $this->sku = $product->skus[0];
            $this->sizes = $this->sku->sizes->load('size')->sortBy('size.value');

            $this->colors = $this->product->skus->pluck('color');
        }
        /*dd($this->sizes);*/
    }
    public function changeAttribute($sku_id)
    {
        $sku = $this->product->skus();
        $this->sku = $sku->where('id', $sku_id)->first();
    }


    public function sizeVal($size_id)
    {
        $this->dispatch('getSize', intval($size_id));
    }
    public function render()
    {
        return view('livewire.product.product-show');
    }

    public function changeSku($sku_id)
    {
        $this->sku = $this->product->skus()->where('id', '=', $sku_id)->first();
        $this->sizes = $this->sku->sizes->load('size')->sortBy('size.value');
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
