<div class="d-flex align-items-center mt-3 gap-2">
    {{--@dd($sku)--}}
    @if(isset($sku->discount_price) && $sku->discount_price>0)
        <h5 class="mb-0 text-decoration-line-through text-light-3">{{$sku->price}} &#8372</h5>
        <h4 class="mb-0">{{$sku->discount_price}} &#8372</h4>
    @else
        <h4 class="mb-0">{{$sku->price}} &#8372</h4>
    @endif
</div>
