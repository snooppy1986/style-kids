
<div class="col" >
    <style>
        .color-item{
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
    </style>
    <div class="card rounded-0 product-card">
        <div class="card-header bg-transparent border-bottom-0">
            <div class="d-flex align-items-center justify-content-end gap-3">
                @if($type == 'product')
                    <livewire:wishlist.wishlist-button wire:ignore :product_id="$product->id" :key="'wishlist-'.$product->id"/>
                @endif
            </div>
        </div>
        <a wire:navigate href="{{route('product.show', ['slug' => session()->get('locale')=='ua' || session()->get('locale')==null ? $product->slug_ua : $product->slug_ru])}}"
            style="height: 348px"
        >
            <img src="{{$product->getThumbnail()}}" class="card-img-top" style="max-height: 348px" alt="Изображение {{$product->shortTitle()}}">
        </a>
        <div class="card-body">
            <div class="product-info" >
                {{--Product categories list--}}
                <div class="mb-2">
                    @foreach($product->categories as $category)
                        <a href="{{route('category.show', ['id'=>$category->id])}}">
                        <span class="product-catergory font-13 mb-1">
                            {{session()->get('locale')=='ru' ? \Illuminate\Support\Str::words($category->title_ru, 3) : \Illuminate\Support\Str::words($category->title_ua, 3)}}
                        </span>
                        </a>
                    @endforeach
                </div>
                {{--End product categories list--}}

                {{--Product title--}}
                <div style="height: 60px">
                    <a wire:navigate href="{{route('product.show', ['slug' => session()->get('locale')=='ua' || session()->get('locale')==null ? $product->slug_ua : $product->slug_ru])}}">
                        <h6 class="product-name mb-2">{{$product->shortTitle()}}</h6>
                    </a>
                </div>
                {{--End product title--}}
                <div>
                    <div class="row mb-2">
                        <div class="col-md-3">
                             <span class="mb-1">
                                {{__('Colors')}}
                             </span>
                        </div>

                        <div class="col-md-9">
                            @foreach($product->skus as $item)
                                <span  wire:click="changeSku({{$item->id}})"
                                       class="d-inline-block rounded-circle color-item {{$item->id == $sku->id ? 'border border-info border-2' : ''}}"
                                       style="background-color: {{$item->color}}"></span>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    {{--sizes line--}}
                        <div class="mt-2 mb-2">
                            <x-sizes-row :product="$product" :sizes="$sizes" :activeSize="$activeSize"/>
                        </div>
                        <hr>
                    {{--price line--}}
                        <div class="mt-2 mb-1 product-price">
                             @if($sku->discount_price)
                                 <span class="me-1 text-decoration-line-through">
                                     {{$sku->price}} &#8372
                                 </span>
                                 <span class="fs-5">{{$sku->discount_price}} &#8372</span>
                             @else
                                 <span class="fs-5">{{$sku->price}} &#8372</span>
                             @endif
                        </div>
                    {{--@foreach($colors as $key => $color)
                        <a wire:navigate href="{{route('product.show', ['slug' => session()->get('locale')=='ua' || session()->get('locale')==null ? $product->slug_ua : $product->slug_ru])}}">
                            <span  class="d-inline-block rounded-circle color-item" style="background-color: {{$color}}"></span>
                        </a>
                    @endforeach--}}
                </div>
                <div class="d-flex align-items-center">
                    <div class="mb-1 product-price">
                       {{-- @if($sku[0]->discount_price)
                            <span class="me-1 text-decoration-line-through">
                                {{$sku[0]->price}} &#8372
                            </span>
                            <span class="fs-5">{{$sku[0]->discount_price}} &#8372</span>
                        @else
                            <span class="fs-5">{{$sku[0]->price}} &#8372</span>
                        @endif--}}
                    </div>
                    <livewire:comment.rating-stars-and-count-reviews :comments="$product->comments"  :margin="true"/>
                    {{--<x-rating-stars rating="{{$product->comments()->avg('rating')}}" margin="{{true}}"/>--}}
                </div>
                <div class="product-action mt-2">
                    <div class="d-grid gap-2">
                        <livewire:cart.cart-button-primary :productId="$product->id"
                                                           :skuId="$sku->id"
                                                           :sizeValue="$activeSize['size_value']"

                        />
                        @if($type=='product')
                            <livewire:modal.show-product-button wire:ignore  :id="$product->id"/>
                        @else
                            <livewire:wishlist.remove-button wire:ignore :product_id="$product->id" :key="$product->id"/>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


