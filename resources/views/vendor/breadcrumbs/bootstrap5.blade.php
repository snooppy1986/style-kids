@unless ($breadcrumbs->isEmpty())
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="margin: 0">
            @foreach ($breadcrumbs as $breadcrumb)

                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item">
                        <a wire:navigate href="{{ $breadcrumb->url }}">
                            @if($breadcrumb->title == 'Главная' || $breadcrumb->title == 'Головна')
                                <i class='bx bxs-home' style="color:#0d6efd;"></i>
                            @else
                                {{ $breadcrumb->title }}
                            @endif

                        </a>
                    </li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->title }}</li>
                @endif

            @endforeach
        </ol>
    </nav>
@endunless
