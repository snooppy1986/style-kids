<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
        {{$category->title}} <i class='bx bx-chevron-down'></i>
    </a>
    @if($category->children)
        <div class="dropdown-menu dropdown-large-menu">
            <x-main-menu-child-item :category="$category" :child="$category->children"></x-main-menu-child-item>
        </div>
        <!-- dropdown-large.// -->

    @endif
    <!-- dropdown-large.// -->
</li>
