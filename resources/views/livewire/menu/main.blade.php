<nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg">
    <div class="offcanvas-header">
        <button class="btn-close float-end"></button>
        <h5 class="py-2">Navigation</h5>
    </div>
    <ul class="navbar-nav">
        <li class="nav-item active">
            <a wire:navigate.hover class="nav-link" href="{{route('main')}}">{{__('Main')}}</a>
        </li>

        @foreach($categories as $key=>$category)
            <li class="nav-item dropdown" wire:key="category-{{$key}}">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                    {{session()->get('locale') && session()->get('locale')=='ua'
                        ? $category->title_ua
                        : $category->title_ru}}
                    <i class='bx bx-chevron-down'></i>
                </a>
             @if($category->children)
                 <div class="dropdown-menu">
                     <x-main-menu-child-item :category="$category" :child="$category->children"></x-main-menu-child-item>
                 </div>
                 <!-- dropdown-large.// -->
             @endif
            <!-- dropdown-large.// -->
            </li>
        @endforeach
    </ul>
</nav>



