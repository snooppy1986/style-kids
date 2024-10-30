<?php

namespace App\Livewire\Bootstrap;

use Livewire\Component;

class BootstrapSelect extends Component
{
    public $areas;
    public $type;

    public function area($area_id)
    {
        /*dump($area_id, $this->type);*/
        $this->dispatch($this->type, $area_id);
    }
    public function render()
    {
        return view('livewire.bootstrap.bootstrap-select');
    }
}
