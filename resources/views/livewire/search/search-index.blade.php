<div  class="page-content">

    <!--start breadcrumb-->
    <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
        <div class="container">
            <div class="page-breadcrumb d-flex align-items-center">
                <h3 class="breadcrumb-title pe-3">{{__('Search for request')}}: "{{$search}}"</h3>
                <div class="ms-auto">
                    {{Breadcrumbs::render('search')}}
                </div>
            </div>
        </div>
    </section>
    <!--end breadcrumb-->
    <!--start shop area-->
    <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="product-wrapper">
                        <div class="product-grid">
                            @if(isset($products) && $products->count())
                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
                                    @foreach($products as $product)
                                        {{--<x-product-item :product="$product" />--}}
                                        <livewire:product.product-item :product="$product" :key="$product->id" />
                                    @endforeach
                                </div>
                                <!--end row-->
                            @else
                                <h4>{{__('On request')}} "{{$search}}" {{__('nothing found')}}.</h4>
                        @endif

                            <!--end row-->
                        </div>
                        <hr>
                        @if(isset($products))
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
