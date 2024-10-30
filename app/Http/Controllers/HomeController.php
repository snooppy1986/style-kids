<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $new_products = Product::query()
            ->whereHas('skus', $filter=function ($query){
                $query->where('new', 1);
            })
            ->with(['skus', 'comments'])
            ->where('active', '=', 1)
            ->limit(8)
            ->get();

        $hit_products = Product::query()
            ->whereHas('skus', $filter=function ($query){
                $query->where('hit', 1);
            })
            ->with(['skus', 'comments'])
            ->where('active', '=', 1)
            ->limit(12)
            ->get();

        $categories = Category::query()->get();

        $slides = Slider::query()->get();
        /*dd(Product::where('active', '=', 1)->get());*/
        return view('home', [
            'hit_products' => $hit_products,
            'newProducts' => $new_products,
            'categories' => $categories,
            'slides' => $slides
        ]);
    }
}
