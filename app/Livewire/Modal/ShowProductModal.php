<?php

namespace App\Livewire\Modal;

use App\Models\Product;
use App\Models\Size;
use App\Models\SizeSku;
use App\Models\Sku;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;

class ShowProductModal extends ModalComponent
{
    public Product $product;
    public  $sizes;
    public $sku;
    public $activeSize;
    public $colors;
    public $key=0;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->sku = $this->product->skus[0];
        $this->sizes = $this->product->skus[0]->sizes;
        $this->activeSize = [
            'product_id' => $this->product->id,
            'size_id' => $this->sizes->count() ? $this->sizes[0]->size->id : 0,
            'size_value' => $this->sizes->count() ? $this->sizes[0]->size->value : 0
        ];
    }

    public function render()
    {
        return view('livewire.modal.show-product-modal', ['product'=>$this->product]);
    }

    public function getSizes($size_id=null)
    {
        if ($size_id){
            $skusIds = $this->product
                ->skus
                ->pluck('sizes', 'color')
                ->collapse()
                ->where('size_id', $size_id)
                ->pluck('sku_id');
            $this->colors = $this->product->skus->whereIn('id', $skusIds)->pluck('color');

            return $this->colors;
        }
        $this->sizes = $this->product->skus->pluck('sizes')->collapse()->unique('size_id')->pluck('size');
        $this->colors = $this->product->skus->pluck('color');
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public function changeSku($sku_id)
    {
        $this->sku = $this->product->skus()->where('id', '=', $sku_id)->first();
        $this->sizes = $this->sku->sizes->load('size')->sortBy('size.value');
        /*dd($this->sizes);*/
        $this->activeSize = [
            'product_id' => $this->product->id,
            'size_id' => $this->sizes[0]->size->id
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
