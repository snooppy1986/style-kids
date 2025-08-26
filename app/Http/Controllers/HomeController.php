<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use App\Repositories\Product\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(ProductRepository $productRepository): View
    {
        $new_products = $productRepository->getNewProducts();

        $hit_products = $productRepository->getHitProducts();
        
        $categories = Category::query()->get();

        $slides = Slider::query()->get();

        return view('home', [
            'hit_products' => $hit_products,
            'newProducts' => $new_products,
            'categories' => $categories,
            'slides' => $slides
        ]);
    }
}
