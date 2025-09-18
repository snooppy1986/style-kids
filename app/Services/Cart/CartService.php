<?php

namespace App\Services\Cart;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getProductFromSession(Product $product)
    {
        $products = null;
        if(Session::has('p_c')){
           foreach (Session::get('p_c') as  $item){
               $product = $product->with([
                       'first_skus'=>function($query) use($item){
                           $query->where('id', '=', $item['skuCode']);
                       }
                   ])
                   ->where('id', $item['product_id'])
                   ->first();
               $products[$item['product_id']] = $product->toArray();
               $products[$item['product_id']]['count'] = $item['count'];
               $products[$item['product_id']]['size_value'] = $item['size_value'];
              
           }
        }
        return $products;
    }
}
