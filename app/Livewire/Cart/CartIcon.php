<?php

namespace App\Livewire\Cart;

use App\Livewire\Product\ProductItem;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;

class CartIcon extends Component
{
    public $cartProducts;
    public int $numberOfProductsInCart = 0;
    public int $total_price = 0;
    public array $products_counts = [];
    public int $count=1;
    /*public int $size=0;*/

    public function mount(){
       /* Session::forget('p_c');*/
        /*dd(Session::get('p_c'));*/
        if(Session::has('p_c')){
            $this->getCardProducts();
        }
        /*dd($this->cartProducts, $this->total_price, Session::get('p_c'));*/
    }

    public function getCardProducts()
    {
        $this->numberOfProductsInCart = 0;
        $this->cartProducts = [];
        $data =  Session::get('p_c');
        /*dump($data);*/
        if($data){
            foreach ($data as $item){
                if($item['skuCode']){
                    $this->cartProducts[$item['product_id']]= Product::query()
                        ->with(['skus'=>function($query) use($item){
                            $query->where('code', $item['skuCode']);
                        }])
                        ->where('id', $item['product_id'])
                        ->first();
                    $this->cartProducts[$item['product_id']]['count'] = $item['count'];
                    $this->cartProducts[$item['product_id']]['size_id'] = $item['size_id'] ?? '';
                    $this->numberOfProductsInCart += $item['count'];
                }else{
                    $this->cartProducts[$item['product_id']] = Product::query()
                        ->with('skus')
                        ->where('id', $item['product_id'])
                        ->first();
                    $this->cartProducts[$item['product_id']]['count'] = $item['count'];
                    $this->cartProducts[$item['product_id']]['size_id'] = $item['size_id'] ?? '';
                    $this->numberOfProductsInCart += $item['count'];
                }

            }
            /*dump($this->cartProducts, $this->count);*/
            $this->getTotalPrice($this->cartProducts);
        }

    }

    public function getTotalPrice($products)
    {
        $this->total_price = 0;

        foreach ($products as $product){
            if($product->skus->count()){
                $price = $product->skus[0]->discount_price ? $product->skus[0]->discount_price : $product->skus[0]->price;

                $this->total_price += $price*$product->count;
            }

            /*dd($product, $price, $this->total_price);*/
        }
    }


    public function remove($productId)
    {
        /*$productId = trim($productId, '\'');*/
        $session_data = Session::get('p_c');
        /*dd($productId, $session_data);*/
        unset($session_data[$productId]);
        Session::put('p_c', $session_data);
        $this->getCardProducts();
        $this->dispatch('updateButtonActive', $productId);
    }
    public function render()
    {
        return view('livewire.cart.cart-icon');
    }

    #[On('updateCartList')]
    public function updateList($productId, $skuCode, $count, $sizeValue)
    {
        /*dd($productId, $skuCode, $count, $sizeValue);*/
        /*$skuCode = trim($skuCode, '\'');*/
        if(Session::has('p_c')){
            $data = Session::get('p_c');
            if(!array_key_exists($productId, $data)){

                $data[$productId] = [
                    'product_id'=>$productId,
                    'skuCode'=>$skuCode,
                    'count'=>$count,
                    'size_value'=>$sizeValue
                ];
            }
        }else{

            $data[$productId] = [
                'product_id'=>$productId,
                'skuCode'=>$skuCode,
                'count'=>$count,
                'size_value'=>$sizeValue
            ];
        }
        Session::put('p_c', $data);
        $this->getCardProducts();
        $this->dispatch('updateButtonActive', $skuCode);
    }

    #[On('updateCount')]
    public function update()
    {
        $this->products_counts=[];
        $this->total_price = 0;
        if(Session::has('p_c')){
            foreach (Session::get('p_c') as $item){
                $this->products_counts[$item['skuCode']] = $item['count'];
                /*$this->skusIds[$item['product_id']] = $item['sku_id'];*/
            }
            $this->numberOfProductsInCart = array_sum($this->products_counts);
            /*$this->product_ids = array_keys(Session::get('p_c'));*/
        }else{
            $this->count = 1;
            $this->product_ids = [];
        }
        $this->getCardProducts();
    }
}
