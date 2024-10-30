<?php

namespace App\Observers;

use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderObserver
{
    /**
     * Handle the Slider "saved" event.
     */
    public function saved(Slider $slider): void
    {
        if($slider->isDirty('image')){
            if($slider->getOriginal('image')){
                Storage::disk('public')->delete($slider->getOriginal('image'));
            }

        }
    }

    /**
     * Handle the Slider "deleted" event.
     */
    public function deleted(Slider $slider): void
    {
        if(!is_null($slider->image)){
            Storage::disk('public')->delete($slider->image);
        }
    }
}
