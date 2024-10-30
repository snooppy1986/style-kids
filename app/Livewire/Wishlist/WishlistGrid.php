<?php

namespace App\Livewire\Wishlist;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class WishlistGrid extends Component
{
    public $id;
    public $products = [];
    protected $listeners = [
        'wishlist-delete-item' => 'delete'
    ];

    public function mount()
    {
        $product_ids = Session::get('w_l');
        $this->products = Session::has('w_l') ? Product::query()->whereIn('id', $product_ids)->get() : [];
    }

    public function delete($product_id)
    {
        /*update session*/
        $data_remove = Session::get('w_l');
        array_splice($data_remove, array_search($product_id, $data_remove), 1);
        Session::put('w_l', $data_remove);
        /*Wishlist::query()
            ->where('wishlist_id', '=', $this->wishlist_id)
            ->where('product_id', '=', $product_id)
            ->delete();*/
        /*update products list*/
        $this->products = $this->products->filter(function ($value) use ($product_id){
            return $value['id'] != $product_id;
        });

        if(!$this->products->count()){
            Session::forget('w_l');
        }
        $this->dispatch('wishlist-update');
    }

    public function render()
    {
        return view('livewire.wishlist.wishlist-grid', [
            'products' => $this->products
        ]);
    }
}
