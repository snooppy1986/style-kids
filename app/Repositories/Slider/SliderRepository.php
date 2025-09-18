<?php

namespace App\Repositories\Slider;

use App\Models\Slider;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;

class SliderRepository extends BaseRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected Slider $slider)
    {
        parent::__construct($this->slider);
    }

    public function getAllSliders()
    {
        return Cache::remember('sliders', 3600, function()  {
            return $this->model->all();
        });
        
    }
}
