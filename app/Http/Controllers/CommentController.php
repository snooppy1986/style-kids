<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Product $product)
    {
        $data = $request->validated();
        $product->comments()->create($data);        
    }
}
