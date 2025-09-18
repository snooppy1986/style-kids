<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Cart\CartService;

class CartController extends Controller
{
    public function index(CartService $cartService, Product $product)
    {
        $products = $cartService->getProductFromSession($product);
       
        return view('cart.index', compact('products'));
    }
}
