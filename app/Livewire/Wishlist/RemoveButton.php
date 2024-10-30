<?php

namespace App\Livewire\Wishlist;

use Livewire\Component;

class RemoveButton extends Component
{
    public $product_id;

    public function remove($product_id)
    {

        $this->dispatch('wishlist-delete-item', $product_id);
    }

    public function render()
    {
        return view('livewire.wishlist.remove-button');
    }
}
