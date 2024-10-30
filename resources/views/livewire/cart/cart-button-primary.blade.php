{{--<div class="w-100">
    <button wire:click="toCart({{$productId}}, {{$skuId}})"
            class="btn btn-white btn-ecomm btn-action {{array_key_exists($productId, $productCart) ? 'bg-success' : ''}}">
        <i class='bx bxs-cart-add mr-3' style="margin-right: 20px"></i>
        Купить
        @if(array_key_exists($productId, $productCart))
            <i class="bx bxs-check-shield " style="margin-left: 20px"></i>
        @endif
    </button>
</div>--}}
@php
    //$skuCode = trim($skuCode, '\'');

    $status = array_key_exists($productId, $productCart);

@endphp
<div class="w-100">
    <button wire:click="addProductToCart({{$productId}}, {{$skuId}}, {{$sizeValue}}, {{$status}})"
            class="btn btn-white btn-ecomm btn-action {{$status ? 'bg-success' : ''}}">
        <i class='bx bxs-cart-add mr-3' style="margin-right: 20px"></i>
        {{$status ? 'оформить' : 'Купить'}}
        @if($status)
            <i class="bx bxs-check-shield " style="margin-left: 20px"></i>
        @endif
    </button>
</div>
