<?php

namespace App\Livewire\Wishlist;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class WishlistIcon extends Component
{
    public $wishlist_count = null;

    protected $listeners = [
        'wishlist-update' => 'updateWishList'
    ];

    public function mount()
    {
        $this->updateWishList();
    }

    public function updateWishList()
    {
        if(Session::has('w_l')){
            if(!is_array(Session::get('w_l'))){
                $data[] =Session::get('w_l');
                $this->wishlist_count = count($data);
            }else{
                $this->wishlist_count = count(Session::get('w_l'));
            }
        }else{

            $this->wishlist_count = null;
        }

    }

    public function render()
    {
        return view('livewire.wishlist.wishlist-icon', [
            'wishlist_count'=>$this->wishlist_count
            ]);
    }
}
