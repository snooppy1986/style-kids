<!--start quick view product-->

<!-- Modal -->
<div class="flex justify-center items-center">
    <style>
        .btn-close:hover{
            font-weight: 800;
        }
        .btn-close:focus{
            box-shadow: none;
        }
    </style>
    <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-xl-do">
        <div class="modal-content rounded-0 border-0">
            <div class="modal-header">
                <h3 class="text-uppercase fw-bolder">{{$product->shortTitle()}}</h3>
                <button wire:click="$dispatch('closeModal')" type="button" class="btn-close float-end me-1"></button>
            </div>
            <div class="modal-body">
                @isset($product)
                    <div class="row g-0">
                        <div class="col-12 col-lg-6">
                            <div wire:ignore class="image-zoom-section">
                                <div class="product-gallery owl-carousel owl-theme border mb-3 p-3" data-slider-id="1">
                                    @foreach($product->productGallery as $slide)
                                        <div class="item">
                                            <img src="{{asset($slide->getImage())}}" class="img-fluid" alt="">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="owl-thumbs d-flex justify-content-center" data-slider-id="1">
                                    @foreach($product->productGallery as $slide)
                                        <button class="owl-thumb-item">
                                            <img src="{{asset($slide->getImage())}}" class="" alt="">
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="product-info-section p-3">
                                <h3 class="mt-3 mt-lg-0 mb-0 text-uppercase fw-bolder">{{$product->shortTitle()}}</h3>
                                <livewire:comment.rating-stars-and-count-reviews :comments="$product->comments" :showCountReviews="true"/>
                                {{--@if($product->comments()->count())
                                    <livewire:comment.rating-stars-and-count-reviews :comments="$product->comments"/>
                                @endif--}}
                                <div class="d-flex align-items-center mt-3 gap-2">
                                    {{--@dd($product->skus);--}}
                                    @if($product->skus[0]->discount_price)
                                        <h5 class="mb-0 text-decoration-line-through text-light-3">{{$product->skus[0]->price}} &#8372</h5>
                                        <h4 class="mb-0">{{$product->skus[0]->discount_price}} &#8372</h4>
                                    @else
                                        <h4 class="mb-0">{{$product->skus[0]->price}} &#8372</h4>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <h6>{{__('Description')}} :</h6>
                                    <p class="mb-0">{!! $product->shortBody() !!}</p>
                                </div>
                                <dl class="row mt-3">
                                    <dt class="col-sm-3">{{__('Code product')}}</dt>
                                    <dd class="col-sm-9">{{$product->code}}</dd>
                                    <dt class="col-sm-3">{{__('Delivery')}}</dt>
                                    <dd class="col-sm-9">{{__('New post')}}, {{__('Ukr post')}} <dd>
                                </dl>
                                <div class="row row-cols-auto align-items-center mt-3">
                                    <div class="col col-md-2">
                                        <label class="form-label">{{__('Qty')}}</label>
                                        <div class="cart-action text-center">
                                            <input type="number" class="form-control rounded-0 form-select-sm" value="1" min="1">
                                        </div>
                                    </div>
                                    @if($sizes->count())
                                        <x-sizes-row :product="$product" :sizes="$sizes" :activeSize="$activeSize"/>
                                    @endif

                                    <div class="col">
                                        <label class="form-label">{{__('Colors')}}</label>
                                        <div  class="color-indigators d-flex align-items-center gap-2">
                                            @foreach($product->skus as $key=>$item)
                                                <span  wire:click="changeSku({{$item->id}})"
                                                       class="d-inline-block rounded-circle color-indigator-item {{$item->id == $sku->id ? 'border border-info border-2' : ''}}"
                                                       style="background-color: {{$item->color}}"></span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!--end row-->
                                <div class="d-flex gap-2 mt-3">

                                    <livewire:cart.cart-button-primary wire:ignore
                                                                       :productId="$product->id"
                                                                       :skuId="$sku->id"
                                                                       :sizeValue="$activeSize['size_value']" />

                                    <livewire:wishlist.wishlist-button  :product_id="$product->id" :type="'button'" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                @endisset
            </div>
        </div>
    </div>
</div>
<!--end quick view product-->
@script
    <script>
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            responsiveClass:true,
            nav:false,
            dots: false,
            thumbs: true,
            thumbsPrerendered: true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        })
    </script>
@endscript
