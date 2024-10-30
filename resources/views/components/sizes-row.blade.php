<div class="col">
    <style>
        .tag-link:hover,
        .active-tag-link{
            background: grey !important;
            color: black !important;
        }
    </style>
    <label class="form-label">{{$product->type == 'cloth' ? __('Age group') : __('Size')}}</label>
    {{--@dd($sizes)--}}
    <div class="row">
        <div class="tags-box">
            {{--@dd($sizes)--}}
            @foreach($sizes as $item_size)
                <a wire:click="changeSize({{$product->id}}, {{$item_size->size->id}})"
                   href="javascript:;"
                   class="tag-link {{$activeSize['product_id'] == $product->id && $activeSize['size_id'] == $item_size->size->id ? 'active-tag-link' : ''}}">
                    {{$item_size->size->value}} {{$product->type == 'cloth' ? trans_choice(session()->get('locale') ? session()->get('locale').'.years' : \Illuminate\Support\Facades\Lang::getLocale().'.years', $item_size->size->value) : ''}}
                </a>
                {{--<div class="w-25 border border-success m-2" aria-current="page" href="#">
                    {{$item_size->size->value}} {{$product->type == 'cloth' ? trans_choice(session()->get('locale') ? session()->get('locale').'.years' : \Illuminate\Support\Facades\Lang::getLocale().'.years', $item_size->size->value) : ''}}
                </div>--}}
            @endforeach
        </div>

    </div>

    {{--<select wire:change="getSizes($event.target.value)" class="form-select form-select-sm">
        @foreach($sizes as $item_size)
            <option value="{{$item_size->size->id}}">
                {{$item_size->size->value}} {{$product->type == 'cloth' ? trans_choice(session()->get('locale') ? session()->get('locale').'.years' : \Illuminate\Support\Facades\Lang::getLocale().'.years', $item_size->size->value) : ''}}
            </option>
        @endforeach
    </select>--}}
</div>
<script>

</script>
