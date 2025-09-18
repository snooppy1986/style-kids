<?php

namespace App\Livewire\Search;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class MainSearch extends Component
{
    public $search;
    public $products;
    public $categories;
    public $category=null;
    public function mount()
    {
        $this->categories = Category::query()->whereNull('parent_id')->get();
    }
    public function searchAction()
    {
        /*dd(strlen($this->search));*/
        if(strlen($this->search)>1){
            if(!$this->category){
                $this->products = Product::query()
                    ->where('title_ru', 'like', "%$this->search%")
                    ->orWhere('title_ua', 'like', "%$this->search%")
                    ->limit(5)
                    ->get();

            }else{

                $this->products = Category::find($this->category)
                    ->recursiveProducts()
                    ->where('title_ru', 'like', "%$this->search%")
                    ->orWhere('title_ua', 'like', "%$this->search%")
                    ->limit(5)
                    ->get();
            }
        }else{
            $this->products = null;
        }

    }

    #[On('clear_search')]
    public function clear()
    {
        $this->search = null;
        $this->products = null;
    }

    public function setCategory($id)
    {
        $this->category = $id !== 'null' ? $id : null;
        $this->searchAction();
    }

    public function searchPage()
    {
        $category_id = $this->category ? "/$this->category" : '';
        return $this->redirect('/search/'.$this->search.$category_id, true);
    }

    public function render()
    {
        return view('livewire.search.main-search');
    }
}
