<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Size;
use App\Models\SizeSku;
use App\Models\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function index()
    {
        $products = null;
        $allSizes = Size::query()->get();

        $sizes = null;
        if(Session::has('p_c')){
            foreach (Session::get('p_c') as  $item){

                $product = Product::query()
                    ->with([
                        'first_skus'=>function($query) use($item){
                            $query->where('id', '=', $item['skuCode']);
                        }
                    ])
                    ->where('id', $item['product_id'])
                    ->first();

                $products[$item['product_id']] = $product->toArray();
                $products[$item['product_id']]['count'] = $item['count'];
                $products[$item['product_id']]['size_value'] = $item['size_value'];

                /*if($item['size_value']){
                    $products[$item['product_id']]['size'] = $item['size_value'];
                }else{

                    $skus_ids = $product->skus->pluck('id');
                    $sizes = SizeSku::query()
                        ->with('size')
                        ->whereIn('sku_id', $skus_ids)
                        ->get()
                        ->pluck('size');
                    $products[$item['product_id']]['sizes'] = $sizes->sortBy('value');
                }
                if(!$item['skuCode']){
                    $products[$item['product_id']]['readyForPurchase'] = false;
                }else{
                    $products[$item['product_id']]['sku_id'] = Sku::query()
                        ->where('code', '=', $item['skuCode'])
                        ->first('id')
                        ->id;
                    $products[$item['product_id']]['readyForPurchase'] = true;
                }*/
            }
        }
        /*dd($products, Session::get('p_c'));*/
        return view('cart.index', compact('products'));
    }
}
