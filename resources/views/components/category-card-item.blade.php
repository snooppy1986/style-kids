<div class="col">
    <div class="card rounded-0 product-card">
        <a wire:navigate href="{{route('category.show', ['id'=>$category->id])}}">
            <img src="{{$category->getThumbnail()}}" class="card-img-top border-bottom bg-dark-1" alt="Картинка {{$category->title}}">
        </a>

        <div class="list-group list-group-flush">
            <a wire:navigate href="{{route('category.show', ['id'=>$category->id])}}" class="list-group-item bg-transparent">
                <h6 class="mb-0 text-uppercase">{{session()->get('locale')=='ru' ? $category->title_ru : $category->title_ua}}</h6>
            </a>

            @isset($category->descendants)
                @foreach($category->descendants as $child)
                    <a wire:navigate href="{{route('category.show', ['id'=>$child->id])}}" class="list-group-item bg-transparent d-flex justify-content-between align-items-center">
                        {{session()->get('locale')=='ru' ? $child->title_ru : $child->title_ua}}
                        @if($child->products->count() > 0)
                            <span class="badge bg-primary rounded-pill">{{$child->products->count()}}</span>
                        @endif

                    </a>
                @endforeach
            @endisset


        </div>
    </div>
</div>
