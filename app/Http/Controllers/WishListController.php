<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function show()
    {
        return view('wishlist.show');
    }
}
