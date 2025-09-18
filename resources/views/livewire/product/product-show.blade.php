@php
    $count=1;
@endphp
@section('metatags')
    <x-meta_tags :data="$product" />
@endsection
<div class="page-content" wire:ignore.self>
    <style>
        /*.owl-item{
            width: 207px !important;
        }*/
    </style>
    <!--start breadcrumb-->
    <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
        <div class="container">
            <div class="page-breadcrumb d-flex align-items-center">
                <div class="ms-auto">
                    {{\Diglactic\Breadcrumbs\Breadcrumbs::render('product', $product)}}
                </div>
            </div>
        </div>
    </section>
    <!--end breadcrumb-->
    <!--start product detail-->
    <section class="py-4 {{$opacity ? 'product-opacity' : ''}}">
        <div class="container">
            <div class="product-detail-card">
                <div class="product-detail-body">
                    <div class="row g-0">
                        <div wire:ignore class="col-12 col-lg-5">
                            <div class="image-zoom-section">
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
                        <div class="col-12 col-lg-7">
                            <div class="product-info-section p-3">
                                <h3 class="mt-3 mt-lg-0 mb-0 fw-bold">{{$product->shortTitle()}}</h3>
                                <div class="product-rating d-flex align-items-center mt-2">
                                    <x-rating-stars rating="{{$product->comments()->avg('rating')}}" margin="{{false}}"/>
                                    @if($product->comments()->count())
                                        <div class="ms-1">
                                            <p class="mb-0">({{$product->comments()->count()}} Отзыва)</p>
                                        </div>
                                    @endif
                                </div>
                                <x-price-box :sku="$sku"/>
                                <div class="mt-3">
                                    <h6>{{__('Description')}} :</h6>
                                    <p class="mb-0">{!! $product->shortBody() !!}</p>
                                </div>
                                <dl class="row mt-3">
                                    <dt class="col-sm-3">Код продукта</dt>
                                    <dd class="col-sm-9">{{$sku->code}}</dd>
                                    <dt class="col-sm-3">{{__('Delivery')}}</dt>
                                    <dd class="col-sm-9">{{__('New post')}}, {{__('Ukr post')}}<dd>
                                </dl>
                                <div class="row row-cols-auto align-items-center mt-3">
                                    <div class="col col-md-2">
                                        <label for="count" class="form-label">{{__('Qty')}}</label>
                                        <div  class="cart-action text-center">
                                            <input
                                                @click="getCount()"
                                                {{--wire:model="count"--}}
                                                type="number"
                                                class="form-control rounded-0 form-select-sm"
                                                id="count"
                                                :value="1"
                                                min="1"
                                            >
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
                                                {{--<a wire:navigate
                                                   href="{{route('product.show', ['slug' => session()->get('locale')=='ua' || session()->get('locale')==null ? $product->slug_ua : $product->slug_ru, 'color'=>$item->color])}}">
                                                    <div --}}{{--wire:click="changeAttribute({{$item->id}})"--}}{{--
                                                         class="{{$item->id == $sku->id ? 'border-info' : ''}} color-indigator-item rounded-circle border border-2"
                                                         style="background-color: {{$item->color}};"
                                                         data-id="{{$item->id}}"
                                                         --}}{{--@click="opacity()"--}}{{--
                                                    ></div>
                                                </a>--}}
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!--end row-->
                                <div class="d-flex gap-2 mt-3 mb-3">
                                    <div style="margin-right: 20px">
                                        <livewire:cart.cart-button-primary
                                            :productId="$product->id"
                                            :skuId="$sku->id"
                                            :sizeValue="$activeSize['size_value']"
                                        />
                                    </div>

                                    <livewire:wishlist.wishlist-button :product_id="$product->id"/>
                                </div>
                                <hr/>
                                <div class="product-sharing">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <a href="javascript:;"><i class='bx bxl-facebook text-dark'></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        	<a href="javascript:;"><i class='bx bxl-linkedin text-dark'></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        	<a href="javascript:;"><i class='bx bxl-twitter text-dark'></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        	<a href="javascript:;"><i class='bx bxl-instagram text-dark'></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                        	<a href="javascript:;"><i class='bx bxl-google text-dark'></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
    </section>
    <!--end product detail-->
    <!--start product more info-->
    <section class="py-4">
        <div class="container">
            <div class="product-more-info">
                <ul class="nav nav-tabs mb-0" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#discription" role="tab" aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-title text-uppercase fw-500">{{__('Description')}}</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#more-info" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-title text-uppercase fw-500">Характеристики</div>
                            </div>
                        </a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#reviews" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-title text-uppercase fw-500">({{count($product->comments)}}) {{__('Reviews')}}</div>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="tab-content pt-3">
                    <div class="tab-pane fade show active" id="discription" role="tabpanel">
                        <p>{!!session()->get('locale') && session()->get('locale')=='ua' ? $product->body_ua : $product->body_ru !!}</p>
                    </div>

                    <div class="tab-pane fade" id="more-info" role="tabpanel">
                        <x-product-option-table :characteristics="$product->productCharacteristics"></x-product-option-table>
                    </div>

                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <livewire:comment.comment :model="$product" :key="'comment-'.$product->id" />
                        <!--end row-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end product more info-->
    <!--start similar products-->
    <section class="py-4">
        @if($similar_products->count())
            <div class="container">
                <div class="d-flex align-items-center">
                    <h5 class="text-uppercase mb-0">{{__('Similar products')}}</h5>
                    <div class="d-flex align-items-center gap-0 ms-auto">
                        <a href="javascript:;" class="owl_prev_item fs-2"><i class='bx bx-chevron-left'></i></a>
                        <a href="javascript:;" class="owl_next_item fs-2"><i class='bx bx-chevron-right'></i></a>
                    </div>
                </div>
                <hr/>
                {{--@dump($similar_products)--}}
                <div wire:ignore class="product-grid">
                    <div class="owl-carousel owl-theme similar-products">
                        @foreach($similar_products as $product)
                            {{--<livewire:product.product-item wire:ignore :product="$product" :key="$product->id"/>--}}
                            <x-product-item  :product="$product" />
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

    </section>
    <!--end similar products-->
</div>

@push('scripts')
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/plugins/OwlCarousel/js/owl.carousel.min.js')}}" data-navigate-track></script>
    <script src="{{asset('assets/plugins/OwlCarousel/js/owl.carousel2.thumbs.min.js')}}"></script>
@endpush

<script>
    function opacity(){
        let body = document.body
        body.classList.add('product-opacity');
        setTimeout(()=>{
            body.classList.remove('product-opacity')
        }, 500)
    }
    var colors = document.querySelectorAll('.color-indigator-item');

    colors.forEach((item, idx) => {
        item.addEventListener('click', () => {
            ToggleActive(item,idx);
        });
    });

    function ToggleActive(el,index) {
        el.classList.toggle('border-info');
        colors.forEach((item,idx) => {
            if(idx !== index){
                item.classList.remove("border-info");
            }
        });
    }

    function getCount(){
        let count = document.getElementById('count').value;
        Livewire.dispatch('getCount', {count: count})
    }



    document.addEventListener('livewire:init', () => {
        console.log('livewire init');
        if ($('.similar-products').length) {
            var viewedSlider = $('.similar-products');

            viewedSlider.owlCarousel(
                {
                    loop: true,
                    margin: 30,
                    autoplay: true,
                    autoplayTimeout: 6000,
                    nav: false,
                    dots: false,
                    responsive:{
                        0:{
                            items:1
                        },
                        576:{
                            items:2
                        },
                        768:{
                            items:3
                        },
                        1366:{
                            items:4
                        },
                        1400:{
                            items:5
                        }
                    },
                });

            if ($('.owl_prev_item').length) {
                var prev = $('.owl_prev_item');
                prev.on('click', function () {
                    viewedSlider.trigger('prev.owl.carousel');
                });
            }

            if ($('.owl_next_item').length) {
                var next = $('.owl_next_item');
                next.on('click', function () {
                    viewedSlider.trigger('next.owl.carousel');
                });
            }
        }
        Livewire.on('update_input_count', (event) => {
            document.getElementById('count').value = 1;
        });
    })

    document.addEventListener('livewire:navigated', () => {
        if ($('.similar-products').length) {
            var viewedSlider = $('.similar-products');

            viewedSlider.owlCarousel(
                {
                    loop: true,
                    margin: 30,
                    autoplay: true,
                    autoplayTimeout: 6000,
                    nav: false,
                    dots: false,
                    responsive:{
                        0:{
                            items:1
                        },
                        576:{
                            items:2
                        },
                        768:{
                            items:3
                        },
                        1366:{
                            items:4
                        },
                        1400:{
                            items:5
                        }
                    },
                });

            if ($('.owl_prev_item').length) {
                var prev = $('.owl_prev_item');
                prev.on('click', function () {
                    viewedSlider.trigger('prev.owl.carousel');
                });
            }

            if ($('.owl_next_item').length) {
                var next = $('.owl_next_item');
                next.on('click', function () {
                    viewedSlider.trigger('next.owl.carousel');
                });
            }
        }
    })

</script>



