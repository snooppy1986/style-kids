<!--start Featured product-->
<section class="py-4">
    <div class="container">
        <div class="product-grid">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-3">
                @foreach($products as $product)
                    <x-wishlist-item :product="$product"/>
                @endforeach

            </div>
            <!--end row-->
        </div>
    </div>
</section>
<!--end Featured product-->
