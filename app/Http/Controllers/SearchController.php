<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index($search, ?int $category=null)
    {
        return view('search.index', compact('search', 'category'));
    }
}
