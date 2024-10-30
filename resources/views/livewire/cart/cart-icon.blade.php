<div>
    <style>
        .inactive{
            pointer-events: none;
            cursor: default;
        }
        .cart-list>.dropdown-item{
            white-space: normal;
            padding: 1rem .3rem !important;
        }
        .cart-product-cancel:hover{
            background-color: #FF0000;
            color: #FFFFFF;
        }
    </style>
    <li class="nav-item dropdown dropdown-large">
        <a href="/cart-icon"
           class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative cart-link"
           data-bs-toggle="dropdown">
            <span class="alert-count {{!$numberOfProductsInCart ? 'd-none' : ''}}">{{$numberOfProductsInCart}}</span>
            <i class='bx bx-shopping-bag'></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <a href="{{route('cart.index')}}" wire:navigate class="{{!$numberOfProductsInCart ? 'inactive' : ''}}">
                <div class="cart-header">
                    <p class="cart-header-title mb-0">
                        {{$numberOfProductsInCart ?
                            $numberOfProductsInCart.' '.trans_choice(session()->get('locale') ? session()->get('locale').'.products' : \Illuminate\Support\Facades\Lang::getLocale().'.products', $numberOfProductsInCart) :
                             __('Empty cart')}}
                    </p>
                    {{--<p class="cart-header-title mb-0">{{$numberOfProductsInCart ? $numberOfProductsInCart.' товар(ов)' : __('Empty cart')}}</p>--}}
                    <p class="cart-header-clear ms-auto mb-0">{{__('In the cart')}}</p>
                </div>
            </a>

                <div class="cart-list overflow-auto">
                    @if($numberOfProductsInCart)
                        @foreach($cartProducts as $product)
                            <div class="dropdown-item" :key="{{$product->id}}">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <a wire:navigate href="{{route('product.show', ['slug'=>$product->slug_ru])}}">
                                            <h6 class="cart-product-title ">{{$product->shortTitle()}}</h6>
                                            <p class="cart-product-price">
                                                {{$product->count}} X
                                                {{$product->skus->count()  ?
                                                    $product->skus[0]->discount_price ? $product->skus[0]->discount_price : $product->skus[0]->price
                                                    : ''}} &#8372;
                                            </p>
                                        </a>

                                    </div>
                                    {{--<div class="flex-grow-1">
                                        <a wire:navigate href="{{route('product.show', ['slug'=>$product->slug_ru])}}">
                                            <h6 class="cart-product-title ">{{$product->shortTitle()}}</h6>
                                            <p class="cart-product-price">
                                                {{$product->count}} X
                                                {{$product->skus[0]->discount_price ? $product->skus[0]->discount_price : $product->skus[0]->price}}
                                            </p>
                                        </a>
                                    </div>--}}
                                    <div class="position-relative">
                                        <div wire:click.prevent="remove({{$product->id}})" class="cart-product-cancel position-absolute end-0">
                                            <i class='bx bx-x'></i>
                                        </div>
                                        <div class="cart-product">
                                            <img src="{{$product->getThumbnail()}}" class="" alt="Картинка {{$product->shortTitle()}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--<a wire:navigate :key="$product->id" class="dropdown-item" href="{{route('product.show', ['id'=>$product->id])}}">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h6 class="cart-product-title">{{$product->shortTitle()}}</h6>
                                        <p class="cart-product-price">{{$products_counts[$product->id]}} X {{$product->price}}</p>
                                    </div>
                                    <div class="position-relative">
                                        <div wire:click="remove({{$product->id}})" class="cart-product-cancel position-absolute">
                                            <i class='bx bx-x'></i>
                                        </div>
                                        <div class="cart-product">
                                            <img src="{{$product->getThumbnail()}}" class="" alt="Картинка {{$product->shortTitle()}}">
                                        </div>
                                    </div>
                                </div>
                            </a>--}}
                        @endforeach
                    @else
                        <h4 class="text-center align-middle">{{__('Empty cart')}}</h4>
                    @endif
                </div>
                @if($numberOfProductsInCart)
                    <a wire:navigate href="javascript:;">
                        <div class="text-center cart-footer d-flex align-items-center">
                            <h5 class="mb-0">{{__('Total')}}</h5>
                            <h5 class="mb-0 ms-auto">{{$total_price}} &#8372;</h5>
                        </div>
                    </a>
                    <div class="d-grid p-3 border-top">
                        <a wire:navigate href="{{route('cart.index')}}" class="btn btn-dark btn-ecomm">{{__('Cart')}}</a>
                    </div>
                @endif

        </div>
    </li>
</div>
