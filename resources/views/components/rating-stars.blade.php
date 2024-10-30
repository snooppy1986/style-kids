<div class="rates cursor-pointer font-13 {{$margin ? 'ms-auto' : ''}}">
    @if($rating)
        @for($i=1; $i<=5; $i++)
            @if($i<=$rating)
                <i class="bx bxs-star text-warning"></i>
            @else
                <i class="bx bxs-star text-light-4"></i>
            @endif
        @endfor
    @endif

</div>
