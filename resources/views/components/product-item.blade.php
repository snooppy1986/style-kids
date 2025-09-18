<div class="col">
   {{-- @dump($wishlist_product_ids)--}}
    <div class="card rounded-0 product-card">
        <div class="card-header bg-transparent border-bottom-0">
            <div class="d-flex align-items-center justify-content-end gap-3">
                {{--<livewire:wishlist.wishlist-button :product_id="$product->id" :active="true" :key="$product->id"/>--}}
            </div>
        </div>

        <a wire:navigate href="{{route('product.show', ['slug' => session()->get('locale') && session()->get('locale')=='ua' ? $product->slug_ua : $product->slug_ru])}}">
            <img src="{{$product->getThumbnail()}}" class="card-img-top" alt="Изображение {{$product->shortTitle()}}">
        </a>
        <div class="card-body">
            <div class="product-info">
                <a href="">
                    <p class="product-catergory font-13 mb-1">
                        {{session()->get('locale') && session()->get('locale')=='ua' ? $product->categories[0]->title_ua : $product->categories[0]->title_ru}}
                    </p>
                </a>
                <a href="{{route('product.show', ['slug' => session()->get('locale') && session()->get('locale')=='ua' ? $product->slug_ua : $product->slug_ru])}}">
                    <h6 class="product-name mb-2">{{$product->shortTitle()}}</h6>
                </a>
                <div class="d-flex align-items-center">
                    <div class="mb-1 product-price">
                        @if($product->skus[0]->discount_price)
                            <span class="me-1 text-decoration-line-through">
                                                        {{$product->skus[0]->price}} &#8372
                                                    </span>
                            <span class="fs-5">{{$product->skus[0]->discount_price}} &#8372</span>
                        @else
                            <span class="fs-5">{{$product->skus[0]->price}} &#8372</span>
                        @endif

                    </div>
                    <x-rating-stars rating="{{$product->comments()->avg('rating')}}" margin="{{true}}"/>
                </div>
                <div class="product-action mt-2">
                    <div class="d-grid gap-2">
                        {{--<livewire:cart.cart-button-primary wire:ignore  :id="$product->id"/>
                        <livewire:modal.show-product-button :id="$product->id"/>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
