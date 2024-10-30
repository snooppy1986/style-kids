<div class="col">
    <label class="form-label">{{__('Colors')}}</label>
    <div class="color-indigators d-flex align-items-center gap-2">
        @foreach($colors as $color)
            <div class="color-indigator-item rounded border border-secondary" style="background-color: {{$color}}"></div>
        @endforeach
    </div>
</div>
