<div class="col">
    <div class="card rounded-0 product-card">
        <a wire:navigate href="{{route('product.show', ['slug' => session()->get('locale')=='ua' || session()->get('locale')==null ? $product->slug_ua : $product->slug_ru])}}">
            <img src="{{$product->getThumbnail()}}" class="card-img-top" alt="Изображение {{$product->shortTitle()}}">
        </a>
        <div class="card-body">
            <div class="product-info">
                {{-- <a wire:navigate href="javascript:;">
                     <p class="product-catergory font-13 mb-1">Catergory Name</p>
                 </a>--}}
                <a wire:navigate href="{{route('product.show', ['slug' => session()->get('locale')=='ua' || session()->get('locale')==null ? $product->slug_ua : $product->slug_ru])}}">
                    <h6 class="product-name mb-2">{{$product->shortTitle()}}</h6>
                </a>
                <div class="d-flex align-items-center">
                    <div class="mb-1 product-price">
                        @if($product->skus[0]->discount_price)
                            <span class="me-1 text-decoration-line-through">
                                {{$product->skus[0]->price}} &#837
                            </span>
                            <span class="fs-5">{{$product->skus[0]->discount_price}} &#8372</span>
                        @else
                            <span class="fs-5">{{$product->skus[0]->price}} &#8372</span>
                        @endif

                    </div>
                    <div class="cursor-pointer ms-auto">
                        <i class="bx bxs-star text-white"></i>
                        <i class="bx bxs-star text-white"></i>
                        <i class="bx bxs-star text-white"></i>
                        <i class="bx bxs-star text-white"></i>
                        <i class="bx bxs-star text-white"></i>
                    </div>
                </div>
                <div class="product-action mt-2">
                    <div class="d-grid gap-2">
                        <livewire:cart.cart-button-primary wire:ignore :productId="$product->id"/>
                        <livewire:wishlist.remove-button  :product_id="$product->id" :key="$product->id"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
