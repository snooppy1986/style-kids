<x-app-layout>
    <!--start slider section-->
    <section class="slider-section">
        <div class="first-slider">
            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach($slides as $key=>$slide)
                        <li data-bs-target="#carouselExampleDark"
                            data-bs-slide-to="{{$key}}"
                            class="{{$key==0 ? 'active' : ''}}"></li>
                    @endforeach

                </ol>
                <div class="carousel-inner">
                    @foreach($slides as $key=>$slide)
                        <x-slide-item :slide="$slide" :key="$key"></x-slide-item>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleDark" role="button" data-bs-slide="prev">	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleDark" role="button" data-bs-slide="next">	<span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>
    </section>
    <!--end slider section-->
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start information-->
            <section class="py-3 border-top border-bottom">
                <x-information-widget></x-information-widget>
            </section>
            <!--end information-->

            <!--start Featured product-->
            <section class="py-4">
                <div class="container">
                    <div class="d-flex align-items-center">
                        <h5 class="text-uppercase mb-0">{{__('Top sales')}}</h5>
                        <a wire:navigate href="{{route('product.index')}}" class="btn btn-dark btn-ecomm ms-auto rounded-0 ">
                            {{__('All products')}}<i class='bx bx-chevron-right'></i>
                        </a>
                    </div>
                    <hr/>
                    <div class="product-grid">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
                            @foreach($hit_products as $product)
                                <livewire:product.product-item :product="$product" :key="$product->id"/>
                            @endforeach
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </section>
            <!--end Featured product-->
            <!--start New Arrivals-->
            <section class="py-4">
                <div class="container">
                    <div class="d-flex align-items-center">
                        <h5 class="text-uppercase mb-0">{{__('New items')}}</h5>
                        <a href="{{route('product.index', ['type'=>'hit'])}}" class="btn btn-dark ms-auto rounded-0 ">
                            {{__('All new items')}}<i class='bx bx-chevron-right'></i>
                        </a>
                    </div>
                    <hr/>
                    <div class="product-grid">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
                            @foreach($newProducts as $product)
                                <livewire:product.product-item :product="$product" :key="$product->id"/>
                            @endforeach
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </section>
            <!--end New Arrivals-->
            <!--start categories-->
            <section class="py-4">
                <div class="container">
                    <div class="d-flex align-items-center">
                        <h5 class="text-uppercase mb-0">{{__('Categories')}}</h5>
                        <a href="{{route('category.index')}}" class="btn btn-dark ms-auto rounded-0">{{__('All categories')}}<i class='bx bx-chevron-right'></i></a>
                    </div>
                    <hr/>
                    <div class="product-grid">
                        <div class="browse-category owl-carousel owl-theme">
                            @foreach($categories as $category)
                                @if(!$category->parent_id)
                                    <x-category-item :category="$category"></x-category-item>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!--end page wrapper -->
</x-app-layout>
