<div>
    <div class="container">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
            <div class="col">
                <div class="footer-section1 mb-3">
                    <h6 class="mb-3 text-uppercase">{{__('Contact Info')}}</h6>
                    <div class="address mb-3">
                        <p class="mb-0 text-uppercase">{{__('Address')}}</p>
                        <p class="mb-0 font-12">
                            {{session()->get('locale') && session()->get('locale')=='ua' ? $data->address_ua : $data->address_ru}}
                        </p>
                    </div>
                    <div class="phone mb-3">
                        <p class="mb-0 text-uppercase">{{__('Phone number')}}</p>
                        @foreach($data->phones as $phone)
                            <p class="mb-0 font-13">{{$phone->value}}</p>
                        @endforeach
                    </div>
                    <div class="email mb-3">
                        <p class="mb-0 text-uppercase">{{__('Email')}}</p>
                        <p class="mb-0 font-13">{{$data->email}}</p>
                    </div>
                    {{--<div class="working-days mb-3">
                        <p class="mb-0 text-uppercase">WORKING DAYS</p>
                        <p class="mb-0 font-13">Mon - FRI / 9:30 AM - 6:30 PM</p>
                    </div>--}}
                </div>
            </div>
            <div class="col">
                <div class="footer-section2 mb-3">
                    <h6 class="mb-3 text-uppercase">{{__('Categories')}}</h6>
                    <ul class="list-unstyled">
                        @foreach($categories as $category)
                            <li class="mb-1">
                                <a href="{{route('category.show', $category->id)}}">
                                    <i class='bx bx-chevron-right'></i>
                                    {{session()->get('locale') && session()->get('locale')=='ua' ? $category->title_ua : $category->title_ru}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{--<div class="col">
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
            </div>--}}
        </div>
        <!--end row-->
        <hr/>
        <div class="row align-items-center">
            <div class="col text-end">
                <p class="mb-0">Copyright © 2024. All right reserved.</p>
            </div>
            {{--<div class="col text-end">
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
            </div>--}}
        </div>
        <!--end row-->
    </div>
</div>
