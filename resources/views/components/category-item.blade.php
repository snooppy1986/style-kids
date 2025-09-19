<div class="item">
    <div class="card rounded-0 product-card border">
        <div class="card-body">
            @if($category->thumbnail)
                <a wire:navigate href="{{route('category.show', ['id'=>$category->id])}}">
                    <img src="{{$category->getThumbnail()}}"
                        style="height: 200px"
                        width="200"
                        height="200"
                        class="img-fluid"
                        alt="Картинка категории {{$category->title_ua}}">
                </a>
            @endif
        </div>
        <div class="card-footer text-center">
            <a wire:navigate href="{{route('category.show', ['id'=>$category->id])}}">
                <h6 class="mb-1 text-uppercase">{{session('locale')=='ru' ? $category->title_ru : $category->title_ua}}</h6>
            </a>

            {{--<p class="mb-0 font-12 text-uppercase">
                {{$category->recursiveProducts->where('active', '=', 1)->count()}}
                {{trans_choice(session()->get('locale') ? session()->get('locale').'.products' : \Illuminate\Support\Facades\Lang::getLocale().'.products', $category->recursiveProducts->count())}}
            </p>--}}
        </div>
    </div>
</div>
