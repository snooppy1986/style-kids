<div class="product-rating d-flex align-items-center mt-2 {{$margin ? 'ms-auto' : ''}}">
    <div class="rates cursor-pointer font-13">
        @for($i=1; $i<=5; $i++)
            @if($i <= $rating)
                <i class="bx bxs-star text-warning"></i>
            @else
                <i class="bx bxs-star text-light-4"></i>
            @endif
        @endfor
    </div>
    @if($showCountReviews)
        <div class="ms-1">
            <p class="mb-0">({{$comments->count()}} {{__('Reviews')}})</p>
        </div>
    @endif
</div>
