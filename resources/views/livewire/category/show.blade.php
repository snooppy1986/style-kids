@php
    /*$min_price = $products ? $products->sortBy('price')->first()->price : null;
    $max_price = $products ? $products->sortByDesc('price')->first()->price: null;*/
@endphp
@section('metatags')
    <x-meta_tags :data="$category" />
@endsection
<div  class="page-content" id="top">
    <style>
        .category-item-link:hover{
            background-color: #D3D3D3;
        }
    </style>
    <!--start breadcrumb-->
    <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
        <div class="container">
            <div class="page-breadcrumb d-flex align-items-center">
                <h3 class="breadcrumb-title pe-3">{{$category->title}}</h3>
                <div class="ms-auto">
                    {{\Diglactic\Breadcrumbs\Breadcrumbs::render('category', $category)}}
                </div>
            </div>
        </div>
    </section>
    <!--end breadcrumb-->
    <!--start shop area-->
    <section class="py-4">
        <div class="container">
            @if(!empty($products))
               {{-- @dd('hi')--}}
                <div class="row">
                    <div class="col-12 col-xl-3">
                        <div class="btn-mobile-filter d-xl-none"><i class='bx bx-slider-alt'></i>
                        </div>
                        <div class="filter-sidebar d-none d-xl-flex">
                            <div class="card rounded-0 w-100">
                                <div class="card-body">
                                    <div class="align-items-center d-flex d-xl-none">
                                        <h6 class="text-uppercase mb-0">Filter</h6>
                                        <div class="btn-mobile-filter-close btn-close ms-auto cursor-pointer"></div>
                                    </div>
                                    <hr class="d-flex d-xl-none" />
                                    @if($minPrice != $maxPrice)
                                        <div class="price-range mb-3">
                                            <h6 class="text-uppercase mb-3">{{__('Price')}}</h6>
                                            <div wire:ignore  id="slider" class="mt-5 mb-3"></div>
                                            <div class="d-flex align-items-center">
                                                <button type="button"
                                                        onclick="sendPrice()"
                                                        class="btn btn-dark btn-sm text-uppercase rounded-0 font-13 fw-500 ">{{__('Apply')}}</button>
                                            </div>
                                        </div>
                                        <hr>
                                    @endif
                                    <div class="product-categories mt-2">
                                        <h6 class="text-uppercase mb-3">{{__('Categories')}}</h6>
                                        <ul class="list-unstyled mb-0 categories-list">
                                            @foreach($categories as $category)
                                                @if($category->products_count)
                                                    <li class="category-item">
                                                        <a wire:navigate class="category-item-link pt-2 pb-2" href="{{$category->id}}">
                                                            <div class="row">
                                                                <div class="col-md-10">
                                                                    {{session()->get('locale') && session()->get('locale')=='ua' ? $category->title_ua : $category->title_ru}}
                                                                </div>
                                                                <div class="col-md-2  justify-content-center align-self-center">
                                                                    <span class=" badge rounded-pill bg-primary">{{$category->products_count}}</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <hr>

                                    @if($size)
                                        <div class="size-range">
                                            <h6 class="text-uppercase mb-3">{{__('Sizes')}}</h6>
                                            <ul class="list-unstyled mb-0 categories-list">
                                                @foreach($sizes as $key=>$size)
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="{{$key}}" id="{{$size}}">
                                                            <label class="form-check-label" for="Small">{{$size}}</label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-9">
                        <div class="product-wrapper">
                            <div class="toolbox d-flex align-items-center mb-3 gap-2">
                                <div class="d-flex flex-wrap flex-grow-1 gap-1">
                                    <div class="d-flex align-items-center flex-nowrap">
                                        <p class="mb-0 font-13 text-nowrap" >{{__('Sort')}}:</p>
                                        <select class="form-select ms-3 rounded-0" wire:click="sort($event.target.value)">
                                            <option value="created_at asc">{{__('For date')}}</option>
                                            <option value="{{session()->get('locale') && session()->get('locale')=='ua' ? 'title_ua' : 'title_ru'}} asc" >{{__('Name')}} А-Я</option>
                                            <option value="{{session()->get('locale') && session()->get('locale')=='ua' ? 'title_ua' : 'title_ru'}} desc" >{{__('Name')}} Я-А</option>
                                            <option value="price asc" >{{__('From cheap to expensive')}}</option>
                                            <option value="price desc" >{{__('From expensive to cheap')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="product-grid">
                                @if(isset($products))
                                    <div  class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
                                        {{--@dd($products)--}}
                                        @foreach($products as $product)
                                            {{--@dd($product)--}}
                                           {{-- @dump($products->count())--}}
                                            {{--<x-product-item :product="$product" x-lazy/>--}}
                                            <livewire:product.product-item :product="$product"  :key="time().$product->slug"/>
                                        @endforeach
                                    </div>
                                    <!--end row-->
                                @else
                                    <h4>{{__('No products')}}.</h4>
                                @endif
                            </div>
                            <hr>

                            <div class="mt-3">
                                @if($products)
                                    {{$products->links()}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            @else
                <div class="col-lg-12 text-center mt-4" style="height: 200px">
                    <h1>{{__('No products')}}...</h1>
                </div>
            @endif
        </div>
    </section>
    <!--end shop area-->

</div>
@script
    <script>
        $wire.on('scroll', ()=>{
            document.getElementById('top').scrollIntoView();
        })
    </script>
@endscript

<script src="{{asset('assets/plugins/nouislider/nouislider.min.js')}}" ></script>
<script>
    "use strict";

    var slider = document.getElementById('slider');
    var noui_base = document.querySelector('.noUi-base');

    if(noui_base){
        noui_base.remove()
    }

    /*document.querySelector('.noUi-base').remove()*/
    noUiSlider.create(slider, {
        start: [
            {{$minPrice && $minPrice != $maxPrice ? $minPrice : 0}},
            {{$maxPrice && $maxPrice != $minPrice ? $maxPrice : 1}}
        ],
        padding: [0, 0],
        step: 1,
        connect: true,
        behaviour: 'tap-drag',
        tooltips: true,
        format: {
            from: function(value) {
                return parseInt(value);
            },
            to: function(value) {
                return parseInt(value);
            }
        },
        range: {
            'min':{{$minPrice && $minPrice != $maxPrice ? $minPrice : 0}},
            'max':{{$maxPrice && $maxPrice != $minPrice ? $maxPrice : 1}}
        }
    });

    function sendPrice() {
        var sliderValue = slider.noUiSlider.get();

        window.Livewire.dispatch('priceRange', {range_price: sliderValue});
    }

</script>









