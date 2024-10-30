<?php

namespace App\Livewire\Cart;

use App\Models\Sku;
use Illuminate\Support\Facades\Session;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class CartButtonPrimary extends Component
{

    public int $productId;
    #[Reactive]
    public  $skuId;
    #[Reactive]
    public int $sizeValue;

    public int $count=1;
    public array $productCart = [];


    public function mount()    {

        if(Session::has('p_c')){
            $session_data = Session::get('p_c');
            $this->productCart = $session_data;
        }
    }


    public function addProductToCart($productId, $skuId, $sizeValue, $status=false)
    {
        $status ?
            $this->redirectRoute('cart.index', navigate: true) :
            $this->dispatch('updateCartList',
                productId: $this->productId,
                skuCode: $skuId,
                count: $this->count,
                sizeValue: $this->sizeValue
            );
    }

    public function render()
    {
        return view('livewire.cart.cart-button-primary');
    }


    #[On('updateButtonActive')]
    public function updateButtonActive()
    {
        if(Session::has('p_c')){
            $this->productCart = Session::get('p_c');
        }else{
            $this->productCart = [];
        }

    }

    #[On('getCount')]
    public function getCount($count)
    {
        $this->count = $count;
    }
    #[On('getSize')]
    public function getSize($size_id)
    {
        $this->sizeId = $size_id;
    }
}
