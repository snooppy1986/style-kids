<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function complete()
    {
        return view('order.complete');
    }
}
