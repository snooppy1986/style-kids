<div wire:id="$product_id">
    <button wire:click="remove({{$product_id}})"
       class="btn btn-light btn-ecomm btn-action">
        <i class='bx bx-zoom-out'></i>{{__('Remove from favorites')}}
    </button>
</div>
