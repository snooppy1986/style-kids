<div class="col col-md order-4 order-md-2 position-relative">
    <style>
        .form-control:focus,
        .form-select:focus{
            border-color: #ced4da;
            box-shadow: none;
        }
        .search-input{
            border-right: none;
        }
        .clear-search{
            border: none;
            border-top: 1px solid #ced4da;
            border-bottom: 1px solid #ced4da;
        }

    </style>
    <div class="input-group flex-nowrap px-xl-4">
        <input wire:model.live="search"
               wire:keydown="searchAction"
               wire:keydown.enter="searchPage"
               wire:click="searchAction"
               type="text"
               class="form-control w-100 search-input"
               placeholder="{{__('Search products')}}">
        @if(isset($products) && $products->count())
            <span wire:click.prevent="clear" class="input-group-text clear-search" id="addon-wrapping">
                <i class="bx bx-x"></i>
            </span>
        @endif

        <select wire:change="setCategory($event.target.value)" class="form-select flex-shrink-0" aria-label="Default select example" style="width: 10.5rem;">
            <option value="null" selected>{{__('All categories')}}</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{session()->get('locale')  == 'ru' ||  session()->get('locale')==null ? $category->title_ru : $category->title_ua}}</option>
            @endforeach
        </select>
        <span wire:click="searchPage" class="input-group-text cursor-pointer bg-transparent">
            <i class='bx bx-search'></i>
        </span>
    </div>
    @if(isset($products) && $products->count())
        <div class="position-absolute bg-white text-dark w-80 search-box mt-2" style="z-index: 999; width: 91%; margin-left: 24px">
            <ul class="list-group w-100">
                @foreach($products as $product)
                    <a href="{{route('product.show', ['slug' => session()->get('locale')  == 'ru' ||  session()->get('locale')==null ? $product->slug_ru : $product->slug_ua])}}">
                        <li class="list-group-item position-relative">
                            <div class="row">
                                <div class="col-2">
                                    <img src="{{$product->getThumbnail()}}" alt="" width="50" height="50">
                                </div>
                                <div class="col-6">
                                    {{session()->get('locale')  == 'ua' ||  session()->get('locale')==null ? $product->title_ua : $product->title_ru}}
                                </div>
                                <div class="col-4 text-right mh-100">
                                    <span class="fw-bold">
                                        Цена: {{$product->skus[0]->discount_price ? $product->skus[0]->discount_price : $product->skus[0]->price}} &#8372
                                    </span>
                                </div>
                            </div>
                        </li>
                    </a>
                @endforeach
            </ul>
            <div class="w-100 d-flex justify-content-center">
                <button wire:click.prevent="searchPage" href="" class="btn "><i class="bx bx-zoom-in"></i>Показать все результаты</button>
            </div>
        </div>
    @elseif(isset($products) && !$products->count())
        <div class="position-absolute bg-white text-dark w-50 search-box" style="z-index: 999; margin-left: 24px">
            <div class="bg-secondary bg-gradient">
                <a  wire:click.prevent="clear" href="#" class="btn text-white"><i class="bx bx-x-circle"></i>Ничего не найдено</a>
            </div>
        </div>
    @endif
</div>

@script
    <script>
        if($('body').has('.search-box')){
            $('body').on('click', function (){
                $('.search-box').css('display', 'none')
            })
        }
    </script>
@endscript



