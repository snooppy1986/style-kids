<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="{{asset('assets/plugins/OwlCarousel/css/owl.carousel.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/nouislider/nouislider.min.css')}}" rel="stylesheet">
    <!-- loader-->
    <link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{asset('assets/js/pace.min.js')}}"></script>
    {{--<script src="https://cdn.tailwindcss.com"></script>--}}
    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Bootstrap-Select CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- Alpine Js -->
    {{--<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}

    {{--<title>{{isset($title) ? $title : env('APP_NAME', 'Brand-children\'s')}}</title>--}}
    @section('metatags')
        <title>{{env('APP_TITLE')}} | Магазин одежды</title>
        <meta type="keywords" content="">
        <meta type="description" content="">
        <link rel="canonical" href="" >
    @show


</head>

<body>

<b class="screen-overlay"></b>
<!--wrapper-->
<div class="wrapper">
    <!--start top header wrapper-->
    <div class="header-wrapper">
        <div class="top-menu border-bottom">
            <div class="container">
                <nav class="navbar navbar-expand">
                    <div class="shiping-title text-uppercase font-13 d-none d-sm-flex">{{__('Welcome to our shop!')}}</div>

                    <x-language_switcher />
                </nav>
            </div>
        </div>
        <div class="header-content pb-3 pb-md-0">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-4 col-md-auto">
                        <div class="d-flex align-items-center">
                            <div class="mobile-toggle-menu d-lg-none px-lg-2" data-trigger="#navbar_main"><i class='bx bx-menu'></i>
                            </div>
                            <div class="logo d-none d-lg-flex">
                                <a wire:navigate href="{{route('main')}}">
                                    <img src="{{asset($company_info->getLogo())}}" class="logo-icon" alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <livewire:search.main-search />
                    <div class="col-4 col-md-auto order-3 d-none d-xl-flex align-items-center">
                        <div class="fs-1 text-white"><i class='bx bx-headphone'></i>
                        </div>
                        <div class="ms-2">
                            <p class="mb-0 font-13">{{ __('Phone number')}}</p>
                            <h5 class="mb-0">
                                {{$company_info->phones[0]->value}}
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 col-md-auto order-2 order-md-4">
                        <div class="top-cart-icons float-end">
                            <nav class="navbar navbar-expand">
                                <ul class="navbar-nav ms-auto">
                                    <livewire:wishlist.wishlist-icon />
                                    <livewire:cart.cart-icon />
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
        <div class="primary-menu border-top">
            <div class="container">
                <livewire:menu.main :categories="$categories"/>
            </div>
        </div>
    </div>
    <!--end top header wrapper-->
    {{$slot}}
    <!--start footer section-->
    <{{--livewire:modal.show-product-modal />--}}
    @livewire('wire-elements-modal')
    <footer>
        <section class="py-4 border-top bg-light">
            <x-footer-main :data="$company_info" :categories="$categories"/>
        </section>
    </footer>
    <!--end footer section-->

    <!--Start Back To Top Button-->
    <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
</div>
<!--end wrapper-->

<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script data-navigate-once src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->

<script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset('assets/plugins/OwlCarousel/js/owl.carousel.min.js')}}" data-navigate-track></script>
<script src="{{asset('assets/plugins/OwlCarousel/js/owl.carousel2.thumbs.min.js')}}"></script>
<script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/plugins/nouislider/nouislider.min.js')}}" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/i18n/defaults-*.min.js"></script>
<!--app JS-->
<script src="{{asset('assets/js/index.js')}}"></script>
<script src="{{asset('assets/js/product-details.js')}}"></script>

<script src="{{asset('assets/js/product-gallery.js')}}"></script>

<script src="{{asset('assets/js/app.js')}}"></script>
@stack('scripts')

</body>

</html>
