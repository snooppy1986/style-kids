<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory;
    public $fillable = ['image', 'image_path', 'product_id'];
    protected $casts = [
        'image'=>'array'
    ];

    public function getImage()
    {
        if(str_starts_with($this->image, 'http')){
            return $this->image;
        }

        return 'storage/'.$this->image_path;
    }
}
