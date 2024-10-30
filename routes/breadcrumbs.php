<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('main', function (BreadcrumbTrail $trail) {
    $trail->push(
        session()->get('locale') == 'ua' || session()->get('locale') == null ? 'Головна' : 'Главная',
        route('main')
    );
});

// Home > Category
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('main');
    foreach ($category->ancestors as $ancector){
        $trail->push($ancector->shortTitle(), route('category.show', $ancector));
    }
    $trail->push($category->shortTitle(), route('category.show', $category));
});
// Home > All Categories
Breadcrumbs::for('all_categories', function (BreadcrumbTrail $trail){
    $trail->parent('main');
    $trail->push(
        session()->get('locale') == 'ua' || session()->get('locale') == null ? 'Всі категорії' : 'Все категории',
        route('category.index')
    );
});
// Home > All Products
Breadcrumbs::for('all_products', function (BreadcrumbTrail $trail){
    $trail->parent('main');
    $trail->push(
        session()->get('locale') == 'ua' || session()->get('locale') == null ? 'Всі товари' : 'Все товары',
        route('product.index')
    );
});
// Home > Category > Products
Breadcrumbs::for('product', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('category', $product->categories[0]);
    $trail->push($product->shortTitle(), route('product.show', $product));
});
//Home > Wishlist
Breadcrumbs::for('wishlist', function (BreadcrumbTrail $trail){
   $trail->parent('main');
   $trail->push(
       session()->get('locale') == 'ua' || session()->get('locale') == null ? 'Обране' : 'Избранное',
       route('wishlist.show')
   );
});
//Home > Cart
Breadcrumbs::for('cart', function (BreadcrumbTrail $trail){
    $trail->parent('main');
    $trail->push(
        session()->get('locale') == 'ua' || session()->get('locale') == null ? 'Кошик' : 'Корзина',
        route('cart.index')
    );
});
//Home > Order complete
Breadcrumbs::for('order_complete', function (BreadcrumbTrail $trail){
    $trail->parent('main');
    $trail->push(
        session()->get('locale') == 'ua' || session()->get('locale') == null ? 'Замовлення оформлено' : 'Заказ оформлен',
        route('order.complete')
    );
});

//Home > Search
Breadcrumbs::for('search', function (BreadcrumbTrail $trail){
    $trail->parent('main');
    $trail->push(
        session()->get('locale') == 'ua' || session()->get('locale') == null ? 'Пошук' : 'Поиск',
        route('search.index')
    );
});
