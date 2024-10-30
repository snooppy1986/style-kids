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
        /*return Blade::render('<x-comment-item :comments="$comments"/>', ['comments'=>$product->comments]);*/
        /*return view('components.comment-form')->render();*/
        /*return redirect()->route('product.show', ['id' => $product->id]);*/
    }
}
