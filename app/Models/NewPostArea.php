<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewPostArea extends Model
{
    use HasFactory;
    public $fillable =[
        'Ref',
        'AreasCenter',
        'DescriptionRu',
        'Description'
    ];
}
