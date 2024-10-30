<div>
    <style>
        .btn-action{
            width: 100%;
        }
        .btn-ecomm:hover{
            background-color: #0b0d0f;
            color: #ffffff;
        }
    </style>
    <button class="btn btn-light btn-ecomm btn-action"
            onclick="Livewire.dispatch('openModal', {component: 'modal.show-product-modal', arguments: {product: {{$id}}}})"
    >
        <i class='bx bx-zoom-in'></i>{{__('Look')}}
    </button>
    {{--<a href=""
       wire:click.prevent="dataModal({{$id}})"
       onclick="Livewire.dispatch('openModal', {component: 'modal.show-product-modal'})"
       class="btn btn-light btn-ecomm btn-action"
       data-bs-toggle="modal"
       data-bs-target="#QuickViewProduct">
        <i class='bx bx-zoom-in'></i>{{__('Look')}}
    </a>--}}
</div>
