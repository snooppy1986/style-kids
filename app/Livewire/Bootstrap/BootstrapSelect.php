<?php

namespace App\Livewire\Bootstrap;

use Livewire\Attributes\Modelable;
use Livewire\Component;

class BootstrapSelect extends Component
{
    public $areas;
    public $type;
    #[Modelable]
    public $value = '';

    public function area($area_id)
    {
        /*dd($this->type, $area_id);*/
        $this->dispatch($this->type, $area_id);
    }
    public function render()
    {
        return view('livewire.bootstrap.bootstrap-select');
    }
}
