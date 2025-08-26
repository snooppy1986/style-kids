<div wire:ignore>
    @if(!is_string($areas))
        <select wire:change="area($event.target.value)"
            class="form-control form-select  my-select"
            style="border: 1px solid #ced4da;"
            data-style="btn"
            data-live-search="true">
            <option value="" >Выберите</option>
                @foreach($areas as $area)
                    <option value="{{$area->Ref}}" :key="{{$area->Ref}}">
                        {{session()->get('locale')=='ru' ? $area->DescriptionRu : $area->Description}}
                    </option>
                @endforeach
        </select>
    @else
        <input wire:model="value"
               type="text"
               class="form-control rounded-0">
    @endif
</div>
@script
    <script>
        $(document).ready(function () {
            $('.my-select').selectpicker();
        })
    </script>
@endscript
