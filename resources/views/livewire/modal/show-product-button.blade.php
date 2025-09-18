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
</div>
