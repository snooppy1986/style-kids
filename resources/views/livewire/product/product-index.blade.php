@php
    $min_price = $products ? $products->sortBy('price')->first()->price : null;
    $max_price = $products ? $products->sortByDesc('price')->first()->price: null;
@endphp



<div  class="page-content">
    <!--start breadcrumb-->
    <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
        <div class="container">
            <div class="page-breadcrumb d-flex align-items-center">
                <h3 class="breadcrumb-title pe-3">Все товары</h3>
                <div class="ms-auto">
                    {{\Diglactic\Breadcrumbs\Breadcrumbs::render('all_products')}}
                </div>
            </div>
        </div>
    </section>
    <!--end breadcrumb-->
    <!--start shop area-->
    <section class="py-4">
        <div class="container">
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
                                <div class="product-categories">
                                    <h6 class="text-uppercase mb-3">Categories</h6>
                                    <ul class="list-unstyled mb-0 categories-list">
                                        @foreach($categories as $category)
                                            <li>
                                                <a wire:navigate href="{{$category->id}}">
                                                    {{$category->title}}
                                                    @if($category->products->count())
                                                        <span class="float-end badge rounded-pill bg-primary">{{$category->products->count()}}</span>
                                                    @endif
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <hr>
                                <div class="price-range">
                                    <h6 class="text-uppercase mb-3">Цена</h6>
                                    <div wire:ignore  id="slider" class="mt-5 mb-3"></div>
                                    <div class="d-flex align-items-center">
                                        <button type="button"
                                                onclick="sendPrice()"
                                                class="btn btn-dark btn-sm text-uppercase rounded-0 font-13 fw-500">Применить</button>
                                    </div>
                                </div>
                                <hr>
                                <div class="size-range">
                                    <h6 class="text-uppercase mb-3">Size</h6>
                                    <ul class="list-unstyled mb-0 categories-list">
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="Small">
                                                <label class="form-check-label" for="Small">Small</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="Medium">
                                                <label class="form-check-label" for="Medium">Medium</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="Large">
                                                <label class="form-check-label" for="Large">Large</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="ExtraLarge">
                                                <label class="form-check-label" for="ExtraLarge">Extra Large</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-9">
                    <div class="product-wrapper">
                        <div class="toolbox d-flex align-items-center mb-3 gap-2">
                            <div class="d-flex flex-wrap flex-grow-1 gap-1">
                                <div class="d-flex align-items-center flex-nowrap">
                                    <p class="mb-0 font-13 text-nowrap" >Сортировать:</p>
                                    <select class="form-select ms-3 rounded-0" wire:click="sort($event.target.value)">
                                        <option value="created_at asc">По дате</option>
                                        <option value="title asc" >Имя А-Я</option>
                                        <option value="title desc" >Имя Я-А</option>
                                        <option value="price asc" >От дешевых к дорогим</option>
                                        <option value="price desc" >От дорогих к дешевым</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="product-grid">
                            @if(isset($products))
                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
                                    @foreach($products as $product)
                                       {{-- <x-product-item :product="$product" />--}}
                                        <livewire:product.product-item :product="$product" :key="$product->id" />
                                    @endforeach
                                </div>
                                <!--end row-->
                            @else
                                <h4>Товаров пока нет.</h4>
                            @endif
                        </div>
                        <hr>
                        @if($products)
                            {{$products->links()}}
                        @endif

                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </section>
    <!--end shop area-->

</div>

<script src="{{asset('assets/plugins/nouislider/nouislider.min.js')}}" ></script>
<script>
    "use strict";

    var slider = document.getElementById('slider');

    noUiSlider.create(slider, {
        start: [{{$min_price}}, {{$max_price}}],
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
            'min':{{$min_price}},
            'max':{{$max_price}}
        }
    });

    function sendPrice() {
        var sliderValue = slider.noUiSlider.get();

        window.Livewire.dispatch('priceRange', {range_price: sliderValue});

        console.log("sliderValue: ", sliderValue);
    }


</script>










