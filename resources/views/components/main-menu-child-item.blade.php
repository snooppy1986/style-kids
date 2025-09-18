<ul class="dropdown-menu {{isset($submenu) ? 'submenu' : ''}}">
    @foreach($child as $cat)
        <li>
            @if(count($cat->children)>0)
                <a wire:navigate class="dropdown-item d-flex justify-content-between" href="{{route('category.show', ['id'=>$cat->id])}}">
                    {{session()->get('locale') && session()->get('locale')=='ua' ? $cat->title_ua : $cat->title_ru}}
                    <i class='bx bx-chevron-right'></i>
                </a>
                <ul class="submenu dropdown-menu">
                            @foreach($cat->children as $item)
                                <li>
                                    @if(count($item->children)>0)
                                        <a wire:navigate
                                           class="dropdown-item dropdown-toggle dropdown-toggle-nocaret d-flex justify-content-between"
                                           href="{{route('category.show', ['id'=>$item->id])}}"
                                        >
                                            {{session()->get('locale') && session()->get('locale')=='ua' ? $item->title_ua : $item->title_ru}}
                                            <i class='bx bx-chevron-right'></i>
                                        </a>
                                        <x-main-menu-child-item :child="$item->children" :submenu="true"></x-main-menu-child-item>
                                    @else
                                        <a wire:navigate
                                           class="dropdown-item d-flex justify-content-between"
                                           href="{{route('category.show', ['id'=>$item->id])}}"
                                        >
                                            {{session()->get('locale') && session()->get('locale')=='ua' ? $item->title_ua : $item->title_ru}}
                                        </a>
                                    @endif
                                </li>
                            @endforeach

                        </ul>
            @else
                <a class="dropdown-item" href="{{route('category.show',['id'=>$cat->id])}}">
                    {{session()->get('locale')=='ru' ? $cat->title_ru : $cat->title_ua}}
                </a>
            @endif
        </li>
    @endforeach
</ul>

{{--<div class="d-flex flex-row">
    @foreach($child as $key=>$cat)
        <div class="col-md-3">
            <h6 class="large-menu-title">{{$cat->title}}</h6>
            @if(count($cat->children))
                <ul class="">
                    @foreach($cat->children as $item)
                        <li>
                            <a href="#">{{$item->title}}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endforeach
    --}}{{--<!-- end col-3 -->
    <div class="col-md-4">
        <h6 class="large-menu-title">Electronics</h6>
        <ul class="">
            <li><a href="#">Mobiles</a>
            </li>
            <li><a href="#">Laptops</a>
            </li>
            <li><a href="#">Macbook</a>
            </li>
            <li><a href="#">Televisions</a>
            </li>
            <li><a href="#">Lighting</a>
            </li>
            <li><a href="#">Smart Watch</a>
            </li>
            <li><a href="#">Galaxy Phones</a>
            </li>
            <li><a href="#">PC Monitors</a>
            </li>
        </ul>
    </div>
    <!-- end col-3 -->--}}{{--
    --}}{{--<div class="col-md-4">
        <div class="pramotion-banner1">
            <img src="{{$category->getThumbnail()}}" class="img-fluid" alt="" />
        </div>
    </div>--}}{{--
    <!-- end col-3 -->
</div>--}}
<!-- end row -->
