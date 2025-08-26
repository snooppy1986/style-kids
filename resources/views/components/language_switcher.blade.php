<ul class="navbar-nav ms-auto d-none d-lg-flex">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
            <div class="lang d-flex gap-1">
                <div>
                    <i class="flag-icon flag-icon-{{strtolower($current_locale)=='ua' ? 'ua' : ''}}"></i>
                </div>
                <div>
                    <span>{{strtoupper($available_locales[array_search($current_locale, $available_locales)])}}</span>
                </div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-lg-end">
            @foreach($available_locales as $key_locale=>$locale_name)
                @if($locale_name !== $current_locale)
                    <a wire:navigate class="dropdown-item d-flex allign-items-center" href="{{asset('language/'.$locale_name)}}">
                        <i class="flag-icon flag-icon-{{strtolower($locale_name) == 'ua' ? 'ua' : ''}} me-2"></i>
                        <span>{{$key_locale}}</span>
                    </a>
                @endif
            @endforeach
        </div>
    </li>
</ul>
