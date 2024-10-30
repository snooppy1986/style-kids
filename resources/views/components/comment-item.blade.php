
<div class="d-flex align-items-start w-100">
    <div class="review-user">
        <img src="{{asset('storage/images/default-avatar.webp')}}" width="65" height="65" class="rounded-circle" alt="" />
    </div>
    <div class="review-content ms-3">
        <div class="rates cursor-pointer fs-6">
            @for($i=1; $i<=$comment->rating; $i++)
                <i class="bx bxs-star text-light-4"></i>
            @endfor
        </div>
        <div class="d-flex align-items-center mb-2">
            <h6 class="mb-0">{{$comment->name}}</h6>
            <p class="mb-0" style="margin-left: 20px">{{$comment->created_at->format('d-m-Y H:i:s')}}</p>
        </div>
        <p>{{$comment->body}}</p>
    </div>
</div>
<hr/>
