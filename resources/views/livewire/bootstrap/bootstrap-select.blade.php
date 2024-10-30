<div wire:ignore>
    <select wire:change="area($event.target.value)"
        class="form-control form-select  my-select"
        style="border: 1px solid #ced4da;"
        data-style="btn"
        data-live-search="true">
        <option value="" >Выберите</option>
        @foreach($areas as $area)
            <option value="{{$area->Ref}}" :key="{{$area->Ref}}">{{$area->DescriptionRu}}</option>
        @endforeach
    </select>
</div>
@script
    <script>
        $(document).ready(function () {
            $('.my-select').selectpicker();
        })
    </script>
@endscript
