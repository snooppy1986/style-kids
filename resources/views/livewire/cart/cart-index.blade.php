<div class="page-content">
    <style>
        h3,
        h5,
        h6{
            /*font-size: 1.2rem !important;*/
            font-weight: 500 !important;
            line-height: 1.2 !important;
        }
        h6{
            font-size: 1rem !important;
        }
        h5{
            font-size: 1.25rem !important;
        }
        h3{
            font-size: 1.5rem !important;
        }

        .color-item{
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
    </style>
    <!--start breadcrumb-->
    <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
        <div class="container">
            <div class="page-breadcrumb d-flex align-items-center">
                <h3 class="breadcrumb-title pe-3">{{__('Cart')}}</h3>
                <div class="ms-auto">
                    {{\Diglactic\Breadcrumbs\Breadcrumbs::render('cart')}}
                </div>
            </div>
        </div>
    </section>
    <!--end breadcrumb-->
    <!--start shop cart-->
       {{--<section class="py-4">
           <div class="container">
               <div class="shop-cart">
                   <div class="row">
                       <div class="col-12 col-xl-8">
                           <div class="shop-cart-list mb-3 p-3">
                               <div class="row align-items-center g-3">
                                   <div class="col-12 col-lg-6">
                                       <div class="d-lg-flex align-items-center gap-2">
                                           <div class="cart-img text-center text-lg-start">
                                               <img src="assets/images/products/01.png" width="130" alt="">
                                           </div>
                                           <div class="cart-detail text-center text-lg-start">
                                               <h6 class="mb-2">White Regular Fit Polo T-Shirt</h6>
                                               <p class="mb-0">Size: <span>Regular</span>
                                               </p>
                                               <p class="mb-2">Color: <span>White & Blue</span>
                                               </p>
                                               <h5 class="mb-0">$19.00</h5>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col-12 col-lg-3">
                                       <div class="cart-action text-center">
                                           <input type="number" class="form-control rounded-0" value="2" min="1">
                                       </div>
                                   </div>
                                   <div class="col-12 col-lg-3">
                                       <div class="text-center">
                                           <div class="d-flex gap-2 justify-content-center justify-content-lg-end"> <a href="javascript:;" class="btn btn-dark rounded-0 btn-ecomm"><i class='bx bx-x-circle'></i> Remove</a>
                                               <a href="javascript:;" class="btn btn-light rounded-0 btn-ecomm"><i class='bx bx-heart me-0'></i></a>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="my-4 border-top"></div>
                               <div class="row align-items-center g-3">
                                   <div class="col-12 col-lg-6">
                                       <div class="d-lg-flex align-items-center gap-2">
                                           <div class="cart-img text-center text-lg-start">
                                               <img src="assets/images/products/17.png" width="130" alt="">
                                           </div>
                                           <div class="cart-detail text-center text-lg-start">
                                               <h6 class="mb-2">Fancy Red Sneakers</h6>
                                               <p class="mb-0">Size: <span>Small</span>
                                               </p>
                                               <p class="mb-2">Color: <span>White & Red</span>
                                               </p>
                                               <h5 class="mb-0">$16.00</h5>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col-12 col-lg-3">
                                       <div class="cart-action text-center">
                                           <input type="number" class="form-control rounded-0" value="2" min="1">
                                       </div>
                                   </div>
                                   <div class="col-12 col-lg-3">
                                       <div class="text-center">
                                           <div class="d-flex gap-2 justify-content-center justify-content-lg-end"> <a href="javascript:;" class="btn btn-dark rounded-0 btn-ecomm"><i class='bx bx-x-circle'></i> Remove</a>
                                               <a href="javascript:;" class="btn btn-light rounded-0 btn-ecomm"><i class='bx bx-heart me-0'></i></a>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="my-4 border-top"></div>
                               <div class="row align-items-center g-3">
                                   <div class="col-12 col-lg-6">
                                       <div class="d-lg-flex align-items-center gap-2">
                                           <div class="cart-img text-center text-lg-start">
                                               <img src="assets/images/products/04.png" width="130" alt="">
                                           </div>
                                           <div class="cart-detail text-center text-lg-start">
                                               <h6 class="mb-2">Yellow Shine Blazer</h6>
                                               <p class="mb-0">Size: <span>Medium</span>
                                               </p>
                                               <p class="mb-2">Color: <span>Yellow & Blue</span>
                                               </p>
                                               <h5 class="mb-0">$22.00</h5>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col-12 col-lg-3">
                                       <div class="cart-action text-center">
                                           <input type="number" class="form-control rounded-0" value="2" min="1">
                                       </div>
                                   </div>
                                   <div class="col-12 col-lg-3">
                                       <div class="text-center">
                                           <div class="d-flex gap-2 justify-content-center justify-content-lg-end"> <a href="javascript:;" class="btn btn-dark rounded-0 btn-ecomm"><i class='bx bx-x-circle'></i> Remove</a>
                                               <a href="javascript:;" class="btn btn-light rounded-0 btn-ecomm"><i class='bx bx-heart me-0'></i></a>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="my-4 border-top"></div>
                               <div class="row align-items-center g-3">
                                   <div class="col-12 col-lg-6">
                                       <div class="d-lg-flex align-items-center gap-2">
                                           <div class="cart-img text-center text-lg-start">
                                               <img src="assets/images/products/09.png" width="130" alt="">
                                           </div>
                                           <div class="cart-detail text-center text-lg-start">
                                               <h6 class="mb-2">Men Black Hat Cap</h6>
                                               <p class="mb-0">Size: <span>Medium</span>
                                               </p>
                                               <p class="mb-2">Color: <span>Black</span>
                                               </p>
                                               <h5 class="mb-0">$14.00</h5>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col-12 col-lg-3">
                                       <div class="cart-action text-center">
                                           <input type="number" class="form-control rounded-0" value="1" min="1">
                                       </div>
                                   </div>
                                   <div class="col-12 col-lg-3">
                                       <div class="text-center">
                                           <div class="d-flex gap-2 justify-content-center justify-content-lg-end"> <a href="javascript:;" class="btn btn-dark rounded-0 btn-ecomm"><i class='bx bx-x-circle'></i> Remove</a>
                                               <a href="javascript:;" class="btn btn-light rounded-0 btn-ecomm"><i class='bx bx-heart me-0'></i></a>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="my-4 border-top"></div>
                               <div class="d-lg-flex align-items-center gap-2">	<a href="javascript:;" class="btn btn-dark btn-ecomm"><i class='bx bx-shopping-bag'></i> Continue Shoping</a>
                                   <a href="javascript:;" class="btn btn-light btn-ecomm ms-auto"><i class='bx bx-x-circle'></i> Clear Cart</a>
                                   <a href="javascript:;" class="btn btn-white btn-ecomm"><i class='bx bx-refresh'></i> Update Cart</a>
                               </div>
                           </div>
                       </div>
                       <div class="col-12 col-xl-4">
                           <div class="checkout-form p-3 bg-light">
                               <div class="card rounded-0 border bg-transparent shadow-none">
                                   <div class="card-body">
                                       <p class="fs-5">Apply Discount Code</p>
                                       <div class="input-group">
                                           <input type="text" class="form-control rounded-0" placeholder="Enter discount code">
                                           <button class="btn btn-dark btn-ecomm" type="button">Apply Discount</button>
                                       </div>
                                   </div>
                               </div>
                               <div class="card rounded-0 border bg-transparent shadow-none">
                                   <div class="card-body">
                                       <p class="fs-5">Estimate Shipping and Tax</p>
                                       <div class="my-3 border-top"></div>
                                       <div class="mb-3">
                                           <label class="form-label">Country Name</label>
                                           <select class="form-select rounded-0">
                                               <option selected>United States</option>
                                               <option value="1">Australia</option>
                                               <option value="2">India</option>
                                               <option value="3">Canada</option>
                                           </select>
                                       </div>
                                       <div class="mb-3">
                                           <label class="form-label">State/Province</label>
                                           <select class="form-select rounded-0">
                                               <option selected>California</option>
                                               <option value="1">Texas</option>
                                               <option value="2">Canada</option>
                                           </select>
                                       </div>
                                       <div class="mb-0">
                                           <label class="form-label">Zip/Postal Code</label>
                                           <input type="email" class="form-control rounded-0">
                                       </div>
                                   </div>
                               </div>
                               <div class="card rounded-0 border bg-transparent mb-0 shadow-none">
                                   <div class="card-body">
                                       <p class="mb-2">Subtotal: <span class="float-end">$198.00</span>
                                       </p>
                                       <p class="mb-2">Shipping: <span class="float-end">--</span>
                                       </p>
                                       <p class="mb-2">Taxes: <span class="float-end">$14.00</span>
                                       </p>
                                       <p class="mb-0">Discount: <span class="float-end">--</span>
                                       </p>
                                       <div class="my-3 border-top"></div>
                                       <h5 class="mb-0">Order Total: <span class="float-end">212.00</span></h5>
                                       <div class="my-4"></div>
                                       <div class="d-grid"> <a href="javascript:;" class="btn btn-dark btn-ecomm">Proceed to Checkout</a>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <!--end row-->
               </div>
           </div>
       </section>--}}


    <section class="py-4">
        <div class="container">
            <div class="shop-cart">
                <form wire:submit="saveOrder">
                    <div class="row">
                        <div class="col-12 col-xl-8">
                            <div class="shop-cart-list mb-3 p-3">
                                @if($products)
                                    @foreach($products as $key=>$product)

                                        <div wire:key="{{time().$product['id']}}"  class="row align-items-center g-3">
                                            <div class="col-12 col-lg-7">
                                                <div class="d-lg-flex align-items-center gap-2">
                                                    <div class="cart-img text-center text-lg-start">
                                                        <a href="{{route('product.show', ['slug' => session()->get('locale')=='ua' || session()->get('locale')==null ? $product['slug_ua'] : $product['slug_ru']])}}">
                                                            <img src="storage/{{$product['thumbnail']}}" width="130" alt="Картинка {{session()->get('locale')=='ua' || session()->get('locale')==null ? $product['title_ua'] : $product['title_ru']}}">
                                                        </a>
                                                    </div>
                                                    <div class="cart-detail text-center text-lg-start">
                                                        <a href="{{route('product.show', ['slug' => session()->get('locale')=='ua' || session()->get('locale')==null ? $product['slug_ua'] : $product['slug_ru']])}}">
                                                            <h6 class="mb-2">{{session()->get('locale')=='ua' || session()->get('locale')==null ? $product['title_ua'] : $product['title_ru']}}</h6>
                                                        </a>
                                                        <p class="mb-0">

                                                            @if(isset($product['size_value']))
                                                                @if($product['type']=='cloth')
                                                                    {{__('Age group')}}: {{$product['size_value']->value}}
                                                                    {{trans_choice(session()->get('locale') ?
                                                                            session()->get('locale').'.years' :
                                                                            \Illuminate\Support\Facades\Lang::getLocale().'.years',
                                                                    $product['size_value']->value)}}
                                                                @else
                                                                    {{__('Size')}}: {{$product['size_value']}}
                                                                @endif
                                                            @endif
                                                        </p>
                                                        <p class="mb-2">
                                                            {{__('Colors')}}:

                                                            <span class="d-inline-block rounded-circle color-item align-middle 'border border-primary border-2'"
                                                                  style="background-color: {{$product['first_skus'] && $product['first_skus']['color'] ? $product['first_skus']['color'] : ''}}"
                                                            ></span>

                                                        </p>
                                                        <h5 class="mb-0">
                                                            {{$product['first_skus']
                                                                ? $product['first_skus']['discount_price'] ? $product['first_skus']['discount_price']  : $product['first_skus']['price']
                                                                : ''}} &#8372
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-2">
                                                <div class="cart-action text-center">
                                                    <input wire:change="updateCount({{'\''.$key.'\''}}, $event.target.value)"
                                                           type="number"
                                                           class="form-control rounded-0"
                                                           value="{{$products_count[$key]}}"
                                                           min="1">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <div class="text-center">
                                                    <div class="d-flex gap-2 justify-content-center justify-content-lg-end">
                                                        <button wire:click.prevent="remove({{'\''.$key.'\''}})"
                                                                class="btn btn-dark rounded-0 btn-ecomm">
                                                            <i class='bx bx-x-circle'></i>{{__('Delete')}}
                                                        </button>
                                                        <livewire:wishlist.wishlist-button :product_id="$product['id']"  wire:key="w_{{time().$key}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-4 border-top"></div>

                                    @endforeach
                                @else
                                    <div class="alert alert-info">
                                        {{__('There are no products in the basket')}}
                                    </div>
                                @endif
                                <div class="d-lg-flex align-items-center gap-2">
                                    <a wire:navigate href="{{route('main')}}" class="btn btn-dark btn-ecomm">
                                        <i class='bx bx-shopping-bag'></i> {{__('Continue shopping')}}
                                    </a>
                                    @if($products)
                                        <button wire:click.prevent="clearCart" class="btn btn-light btn-ecomm ms-auto">
                                            <i class='bx bx-x-circle'></i> {{__('Clear Cart')}}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            @if($products)
                                <div class="checkout-form p-3 bg-light">
                                    <div class="card rounded-0 border bg-transparent shadow-none">
                                        <div class="card-body">
                                            <p class="fs-5">Информация о покупателе</p>
                                            <div class="my-3 border-top"></div>
                                            <div class="mb-0">
                                                <label class="form-label">{{__('Name')}}</label>
                                                <input wire:model.live="name"
                                                       type="text"
                                                       class="form-control rounded-0 @error('name') border-danger text-danger @enderror">
                                                <div class="text-danger mb-2">@error('name') {{ $message }} @enderror</div>
                                            </div>
                                            <div class="mb-0">
                                                <label class="form-label">{{__('Phone number')}}</label>
                                                <input wire:model.live="surname"
                                                       type="text"
                                                       class="form-control rounded-0  @error('surname') border-danger text-danger @enderror">
                                                <div class="text-danger mb-2">@error('surname') {{ $message }} @enderror</div>
                                            </div>
                                            <div class="mb-0">
                                                <label class="form-label">{{__('Phone number')}}</label>
                                                <input wire:model.live="phone"
                                                       wire:keydown="editPhoneNumber"
                                                       type="tel"
                                                       class="form-control rounded-0 @error('phone') border-danger text-danger @enderror">
                                                <div class="text-danger mb-2">@error('phone') {{ $message }} @enderror</div>
                                            </div>
                                            <div class="mb-0">
                                                <label class="form-label">{{__('Email')}}</label>
                                                <input wire:model.live="email"
                                                       type="email"
                                                       class="form-control rounded-0 @error('email') border-danger text-danger @enderror">
                                                <div class="text-danger mb-2">@error('email') {{ $message }} @enderror</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card rounded-0 border bg-transparent shadow-none">
                                        <div class="card-body">
                                            <p class="fs-5">{{__('Method of delivery')}}</p>
                                            <div class="my-3 border-top"></div>

                                            <div class="mb-3">
                                                <label class="form-label">{{__('Delivery')}}</label>
                                                <select wire:change="deliveryType($event.target.value)" class="form-select rounded-0">
                                                    <option value="" selected>{{__('Select shipping method')}}</option>
                                                    @foreach($delivery_companies as $company)
                                                        <option value="{{$company->id}}" :key="d_{{$company->id}}">{{$company->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3" >
                                                @if($areas)
                                                    <label class="form-label">Область</label>
                                                    <livewire:bootstrap.bootstrap-select :areas="$areas" :type="'cities'"/>
                                                @endif
                                            </div>

                                            <div class="mb-3" >
                                                @if($cities)
                                                    <label class="form-label">{{__('City')}}</label>
                                                    <livewire:bootstrap.bootstrap-select :areas="$cities" :type="'warehouses'" :key="$area_id"/>
                                                @endif
                                            </div>

                                            <div class="mb-3" >
                                                @if($warehouses)
                                                    <label class="form-label">{{__('Department')}}</label>
                                                    <livewire:bootstrap.bootstrap-select :areas="$warehouses" :type="'set_warehouses'" :key="$city_id"/>
                                                @endif
                                            </div>

                                            <div class="mb-0">
                                                <label class="form-label">Zip/Postal Code</label>
                                                <input type="email" class="form-control rounded-0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card rounded-0 border bg-transparent mb-0 shadow-none">
                                        <div class="card-body">
                                            <h5 class="mb-0">{{__('Total')}}: <span class="float-end">{{$total_price}} &#8372</span></h5>
                                            <div class="my-4"></div>
                                            <div class="d-grid">
                                                <button  class="btn btn-dark btn-ecomm">{{__('Place an order')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!--end row-->
                </form>
                <!--end form-->
            </div>
        </div>
    </section>
    <!--end shop cart-->
</div>


