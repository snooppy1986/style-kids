<?php

namespace App\Livewire\Wishlist;


use App\Models\Wishlist;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class WishlistButton extends Component
{
    public $product_id;
    public $type = 'link';
    public $active;
    public $selected=false;
    public $wishListProductsIds=[];
    protected $listeners = [
        'refresh'
    ];
    public function mount()
    {
        /*Session::forget('w_l');*/

        if(!is_array(Session::get('w_l'))){
            $this->wishListProductsIds[]=Session::get('w_l');
        }else{
            $this->wishListProductsIds = Session::get('w_l');
        }

        if($this->wishListProductsIds && in_array($this->product_id, $this->wishListProductsIds)){
            $this->selected = true;
        }
    }

    public function create($product_id)
    {
        if(Session::has('w_l')){
            $data = Session::get('w_l');
            if(!is_array($data)){
                $products_ids = [];
                array_push($products_ids, $data, $product_id);
                Session::put('w_l', $products_ids);
                $this->selected = true;
            }else{
                if(!in_array($product_id, $data)){
                    array_push($data, $product_id);
                    Session::put('w_l', $data);
                    $this->selected = true;
                }else{
                    $data_remove = Session::get('w_l');
                    array_splice($data_remove, array_search($product_id, $data_remove), 1);
                    Session::put('w_l', $data_remove);
                    $this->selected = false;
                }
            }
        }else{
            Session::put('w_l', [$product_id]);
            $this->selected = true;
        }
        $this->dispatch('wishlist-update');
    }

    public function render()
    {
        return view('livewire.wishlist.wishlist-button');
    }
}
