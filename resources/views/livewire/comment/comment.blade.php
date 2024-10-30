<div class="row">
    <div class="col col-lg-8">
        <div class="product-review">
            <h5 class="mb-4">{{count($comments)}} {{__('Reviews For The Product')}}</h5>
            @foreach($comments as $comment)
                <x-comment-item :comment="$comment"></x-comment-item>
            @endforeach
        </div>
    </div>
    <div class="col col-lg-4">
        {{--<livewire:comment.create-comment/>--}}
        <div class="add-review bg-dark-1">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <form wire:submit="save">
                @csrf
                <div class="form-body p-3">
                    <h4 class="mb-4">{{__('Leave comment')}}</h4>
                    <div class="mb-3">
                        <label class="form-label">{{__('Name')}}</label>
                        <input wire:model.live="form.name" type="text" class="form-control rounded-0" >
                        <div>
                            @error('form.name') <span class="error text-danger text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input wire:model.live="form.email" type="text" class="form-control rounded-0">
                        <div>
                            @error('form.email') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{__('Grade')}}</label>
                        <select wire:model.live="form.rating" class="form-select rounded-0">
                            <option selected>{{__('Rate this product')}}</option>
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                        <div>
                            @error('form.rating') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{__('Leave comment')}}</label>
                        <textarea wire:model.live="form.body" class="form-control rounded-0" rows="3"></textarea>
                        <div>
                            @error('form.body') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="d-grid">
                        <button wire:click=""  type="submit" class="btn btn-light btn-ecomm send_comment" >{{__('Send')}}</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
