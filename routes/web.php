<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishListController;
use App\Livewire\Comment\Comment;
use Illuminate\Support\Facades\Route;

Route::get('language/{locale}', function ($locale){
    /*dd($locale);*/
    app()->setLocale($locale);
    session()->put('locale', $locale);

    return redirect()->back();
});

Route::get('/', [HomeController::class, 'index'])->name('main');

//Category routes
Route::prefix('category')->group(function (){
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::get('show/{id}', [CategoryController::class, 'show'])->name('category.show');
});

//Product routes
Route::prefix('product')->group(function (){
    Route::get('/{type?}', [ProductController::class, 'index'])->name('product.index');
    Route::get('show/{slug}/{color?}', [ProductController::class, 'show'])->name('product.show');
});

//Comment routes
Route::prefix('comment')->group(function (){
    Route::post('store/{product}', [CommentController::class, 'store'])->name('comment.store');
});

Route::get('/comments/{id}', Comment::class);

//Wishlist routes
Route::get('wishlist', [WishListController::class, 'show'])->name('wishlist.show');

Route::prefix('cart')->group(function(){
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
});
//Order routes
Route::prefix('order')->group(function(){
    Route::get('complete', [OrderController::class, 'complete'])->name('order.complete');
});
//Search routes
Route::get('search/{search?}/{category?}', [\App\Http\Controllers\SearchController::class, 'index'])->name('search.index');
