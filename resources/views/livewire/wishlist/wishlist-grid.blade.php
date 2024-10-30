<div>
    <!--start Featured product-->
    <section class="py-4">
        <div class="container">
            <div class="product-grid">

                @if(count($products))
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-3">
                        @foreach($products as $product)
                            <livewire:product.product-item :product="$product" :type="'wishlist'" :key="$product->id"/>
                            {{--<livewire:wishlist.wishlist-item :product="$product" :key="$product->id"/>--}}
                        @endforeach
                    </div>
                    <!--end row-->
                @else
                    <h3 class="text-center">{{__('No products in wishlist')}}</h3>
                @endif
            </div>
        </div>
    </section>
    <!--end Featured product-->
</div>


