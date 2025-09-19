<?php

namespace App\Http\Controllers;

use App\Repositories\Category\CategoryRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Slider\SliderRepository;
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
        
        return view('home', [
            'hit_products' => $hit_products,
            'newProducts' => $new_products,
            'categories' => $categories,
            'slides' => $slides
        ]);
    }
}
