<div>
    <li class="nav-item">
        <a href="{{route('wishlist.show')}}"
           class="{{!$wishlist_count ? 'disabled' : ''}} nav-link cart-link position-relative">
            <i class='bx bx-heart'></i>
            @if($wishlist_count)
                <span class="alert-count">{{$wishlist_count ? $wishlist_count : ''}}</span>
            @endif
        </a>
    </li>
</div>
