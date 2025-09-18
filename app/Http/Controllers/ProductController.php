<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\Product\ProductRepository;
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
     * Display the specified resource.
     */
    public function show(
        ProductRepository $productRepository,
        string $slug, 
        string $color=''
    )
    {
        //$locale = session()->get('locale');

        /*dd($color);*/
        $product = $productRepository->getProductBySlug($slug);

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
