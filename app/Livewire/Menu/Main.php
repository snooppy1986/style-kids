<?php

namespace App\Livewire\Menu;

use App\Models\Category;
use Livewire\Component;

class Main extends Component
{
    public $categories;
    public function render()
    {
        return view('livewire.menu.main');
    }
}
