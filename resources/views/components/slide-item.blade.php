<div class="carousel-item {{$key==0 ? 'active' : ''}} bg-dark-gery">
    <div class="row d-flex align-items-center">
        <div class="col d-none d-lg-flex justify-content-end">
            <div class="w-75">
                {!! session()->get('locale')=='ru' ? $slide->body_ru : $slide->body_ua !!}
                {{--<h3 class="h3 fw-light">Hurry up! Limited time offer.</h3>--}}
                {{--<h1 class="h1">Women Sportswear Sale</h1>--}}
                {{--<p class="pb-3">Sneakers, Keds, Sweatshirts, Hoodies &amp; much more...</p>--}}
                @if($slide->product_slug)                   
                <div class="mt-3">
                    <a class="btn btn-dark btn-ecomm" href="{{route('product.show', ['slug'=>$slide->product_slug])}}">
                        {{__('Go to')}} <i class='bx bx-chevron-right'></i>
                    </a>
                </div>
                @endif
            </div>
        </div>
        <div class="col">
            <img src="{{asset($slide->getImage())}}" class="img-fluid" alt="{{ $slide->title }}">
        </div>
    </div>
</div>
