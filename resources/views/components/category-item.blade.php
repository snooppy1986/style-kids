<div class="item">
    <div class="card rounded-0 product-card border">
        <div class="card-body">
            <a wire:navigate href="{{route('category.show', ['id'=>$category->id])}}">
                <img src="{{$category->getThumbnail()}}" class="img-fluid" alt="Картинка категории {{$category->title}}">
            </a>

        </div>
        <div class="card-footer text-center">
            <a wire:navigate href="{{route('category.show', ['id'=>$category->id])}}">
                <h6 class="mb-1 text-uppercase">{{session('locale')=='ru' ? $category->title_ru : $category->title_uk}}</h6>
            </a>

            <p class="mb-0 font-12 text-uppercase">{{count($category->products)}} Products</p>
        </div>
    </div>
</div>
