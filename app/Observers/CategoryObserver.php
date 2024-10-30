<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryObserver
{
    /**
     * Handle the Category "saved" event.
     */
    public function saved(Category $category): void
    {
        if($category->isDirty('thumbnail')){
            if($category->getOriginal('thumbnail')){
                Storage::disk('public')->delete($category->getOriginal('thumbnail'));
            }

        }
    }


    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        if(!is_null($category->thumbnail)){
            Storage::disk('public')->delete($category->thumbnail);
        }
    }


}
