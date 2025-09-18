<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Slider\SliderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(
        ProductRepository $productRepository, 
        CategoryRepository $categoryRepository,
        SliderRepository $sliderRepository
        ): View
    {
        $new_products = $productRepository->getNewProducts();        

        $hit_products = $productRepository->getHitProducts();
        
        $categories = $categoryRepository->getAllCategories();
        
        $slides = $sliderRepository->getAllSliders();
        //dd(Cache::get('new_products'), Cache::get('hit_products'), Cache::get('categories'));
        return view('home', [
            'hit_products' => $hit_products,
            'newProducts' => $new_products,
            'categories' => $categories,
            'slides' => $slides
        ]);
    }
}
