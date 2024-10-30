
<div>
    <style>
        .product-wishlist:hover{
            background-color: #0a53be;
            color: #ffffff;
        }

        .active-wishlist{
            background-color: #0a53be;
            color: #ffffff;
        }

    </style>
        @if($type=='button')
            <a wire:click.prevent="create({{$product_id}})"
               href="javascript:;"
               class="btn  btn-ecomm {{$selected ? 'btn-primary' : 'btn-light'}}"

            >
                <i class="bx bx-heart"></i>{{__('Favourites')}}
            </a>
        @else
            <a wire:click.prevent="create({{$product_id}})"
               href="javascript:;">
                <div class="product-wishlist {{$selected ? 'active-wishlist' : ''}}">
                    <i class='bx bx-heart'></i>
                </div>
            </a>
        @endif
</div>
