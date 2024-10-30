<?php

namespace App\Livewire\Menu;

use App\Models\Category;
use Livewire\Component;

class Main extends Component
{
    public function render()
    {
        $categories = Category::query()
            ->whereNull('parent_id')
            ->get();
        return view('livewire.menu.main')->with('categories', $categories);
    }
}
