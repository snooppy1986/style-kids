<?php

namespace App\Observers;

use App\Models\ProductGallery;
use Illuminate\Support\Facades\Storage;

class ProductGalleryObserver
{
    /**
     * Handle the ProductGallery "saved" event.
     */
    public function saved(ProductGallery $gallery): void
    {
        if($gallery->isDirty('image')){
            if($gallery->getOriginal('image')){
                Storage::disk('public')->delete($gallery->getOriginal('image'));
            }

        }
    }

    /**
     * Handle the ProductGallery "deleted" event.
     */
    public function deleted(ProductGallery $gallery): void
    {
        if(!is_null($gallery->image)){
            Storage::disk('public')->delete($gallery->image);
        }
    }
}
