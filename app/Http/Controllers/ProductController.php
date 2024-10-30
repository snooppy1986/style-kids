<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($type=null)
    {
        return view('product.index', compact('type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug, string $color='')
    {
        $locale = session()->get('locale');

        /*dd($color);*/
        $product = Product::query()
            ->with(['comments', 'skus'])
            ->where('active', 1)
            ->where('slug_ru', $slug)
            ->orWhere('slug_ua', $slug)
            ->first();

        $similar_products = $product->categories[0]->products->where('active', '=', 1);

        return view('product.show', compact('product', 'color', 'similar_products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
