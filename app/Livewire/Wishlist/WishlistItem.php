<?php

namespace App\Livewire\Wishlist;

use Livewire\Component;

class WishlistItem extends Component
{
    public object $product;

    public function render()
    {
        return view('livewire.wishlist.wishlist-item');
    }
}
