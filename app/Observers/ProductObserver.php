<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductObserver
{
    /**
     * Handle the Product "saved" event.
     */
    public function saved(Product $product): void
    {
        if($product->isDirty('thumbnail')){
            if($product->getOriginal('thumbnail')){
                Storage::disk('public')->delete($product->getOriginal('thumbnail'));
            }

        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        if(!is_null($product->thumbnail)){
            Storage::disk('public')->delete($product->thumbnail);
        }
    }

}
