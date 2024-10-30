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
                    {{--<ul class="navbar-nav ms-auto d-none d-lg-flex">
                        <li class="nav-item"> <a class="nav-link" href="order-tracking.html">Track Order</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="about-us.html">About</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="shop-categories.html">Our Stores</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="blog.html">Blog</a>
                        </li>
                        <li class="nav-item">	<a class="nav-link" href="contact-us.html">Contact</a>
                        </li>
                        <li class="nav-item">	<a class="nav-link" href="javascript:;">Help & FAQs</a>
                        </li>
                    </ul>--}}
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
                                    {{--<li class="nav-item">
                                        <a href="account-dashboard.html" class="nav-link cart-link">
                                            <i class='bx bx-user'></i>
                                        </a>
                                    </li>--}}
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
                @livewire('menu.main')
               {{-- <nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg">
                    <div class="offcanvas-header">
                        <button class="btn-close float-end"></button>
                        <h5 class="py-2">Navigation</h5>
                    </div>
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a wire:navigate.hover class="nav-link" href="{{route('main')}}">Главная</a>
                        </li>
                        @livewire('menu.main')
                        --}}{{--<livewire:menu.main />--}}{{--
                       --}}{{-- @foreach($categories as $category)
                            <x-main-menu-item :category="$category"></x-main-menu-item>
                        @endforeach--}}{{--
                    </ul>
                </nav>--}}
            </div>
        </div>
    </div>
    <!--end top header wrapper-->
    {{$slot}}
    <!--start footer section-->
        {{--<livewire:modal.show-product-modal/>--}}
    {{--@livewire('wire-elements-modal')--}}
    <footer>
        <section class="py-4 border-top bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
                    <div class="col">
                        <div class="footer-section1 mb-3">
                            <h6 class="mb-3 text-uppercase">Contact Info</h6>
                            <div class="address mb-3">
                                <p class="mb-0 text-uppercase">Address</p>
                                <p class="mb-0 font-12">123 Street Name, City, Australia</p>
                            </div>
                            <div class="phone mb-3">
                                <p class="mb-0 text-uppercase">Phone</p>
                                <p class="mb-0 font-13">Toll Free (123) 472-796</p>
                                <p class="mb-0 font-13">Mobile : +91-9910XXXX</p>
                            </div>
                            <div class="email mb-3">
                                <p class="mb-0 text-uppercase">Email</p>
                                <p class="mb-0 font-13">mail@example.com</p>
                            </div>
                            <div class="working-days mb-3">
                                <p class="mb-0 text-uppercase">WORKING DAYS</p>
                                <p class="mb-0 font-13">Mon - FRI / 9:30 AM - 6:30 PM</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="footer-section2 mb-3">
                            <h6 class="mb-3 text-uppercase">Shop Categories</h6>
                            <ul class="list-unstyled">
                                <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Jeans</a>
                                </li>
                                <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> T-Shirts</a>
                                </li>
                                <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Sports</a>
                                </li>
                                <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Shirts & Tops</a>
                                </li>
                                <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Clogs & Mules</a>
                                </li>
                                <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Sunglasses</a>
                                </li>
                                <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Bags & Wallets</a>
                                </li>
                                <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Sneakers & Athletic</a>
                                </li>
                                <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Electronis</a>
                                </li>
                                <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Furniture</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <div class="footer-section3 mb-3">
                            <h6 class="mb-3 text-uppercase">Popular Tags</h6>
                            <div class="tags-box"> <a href="javascript:;" class="tag-link">Cloths</a>
                                <a href="javascript:;" class="tag-link">Electronis</a>
                                <a href="javascript:;" class="tag-link">Furniture</a>
                                <a href="javascript:;" class="tag-link">Sports</a>
                                <a href="javascript:;" class="tag-link">Men Wear</a>
                                <a href="javascript:;" class="tag-link">Women Wear</a>
                                <a href="javascript:;" class="tag-link">Laptops</a>
                                <a href="javascript:;" class="tag-link">Formal Shirts</a>
                                <a href="javascript:;" class="tag-link">Topwear</a>
                                <a href="javascript:;" class="tag-link">Headphones</a>
                                <a href="javascript:;" class="tag-link">Bottom Wear</a>
                                <a href="javascript:;" class="tag-link">Bags</a>
                                <a href="javascript:;" class="tag-link">Sofa</a>
                                <a href="javascript:;" class="tag-link">Shoes</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="footer-section4 mb-3">
                            <h6 class="mb-3 text-uppercase">Stay informed</h6>
                            <div class="subscribe">
                                <input type="text" class="form-control radius-30" placeholder="Enter Your Email" />
                                <div class="mt-2 d-grid">	<a href="javascript:;" class="btn btn-dark btn-ecomm radius-30">Subscribe</a>
                                </div>
                                <p class="mt-2 mb-0 font-13">Subscribe to our newsletter to receive early discount offers, updates and new products info.</p>
                            </div>
                            <div class="download-app mt-3">
                                <h6 class="mb-3 text-uppercase">Download our app</h6>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="javascript:;">
                                        <img src="{{asset('assets/images/icons/apple-store.png')}}" class="" width="160" alt="" />
                                    </a>
                                    <a href="javascript:;">
                                        <img src="{{asset('assets/images/icons/play-store.png')}}" class="" width="160" alt="" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
                <hr/>
                <div class="row row-cols-1 row-cols-md-2 align-items-center">
                    <div class="col">
                        <p class="mb-0">Copyright © 2021. All right reserved.</p>
                    </div>
                    <div class="col text-end">
                        <div class="payment-icon">
                            <div class="row row-cols-auto g-2 justify-content-end">
                                <div class="col">
                                    <img src="{{asset('assets/images/icons/visa.png')}}" alt="" />
                                </div>
                                <div class="col">
                                    <img src="{{asset('assets/images/icons/paypal.png')}}" alt="" />
                                </div>
                                <div class="col">
                                    <img src="{{asset('assets/images/icons/mastercard.png')}}" alt="" />
                                </div>
                                <div class="col">
                                    <img src="{{asset('assets/images/icons/american-express.png')}}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
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
