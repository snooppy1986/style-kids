<?php

namespace App\Livewire\Modal;

use Livewire\Component;

class ShowProductButton extends Component
{
    public $id;
    protected $listeners = ['priceRange' => 'priceRange'];

    public function dataModal($id)
    {
        $this->dispatch('dataModal', $id);
    }

    public function render()
    {
        return view('livewire.modal.show-product-button');
    }
}
