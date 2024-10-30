<table class="table">
    <tbody>
        <tr>
            <th scope="col" style="border: none">{{__('Characteristics')}}</th>
        </tr>
        @foreach($characteristics as $characteristic)
            <tr>
                <td>{{$characteristic->title_ru}}</td>
                <td>{{$characteristic->value_ru}}</td>
            </tr>
        @endforeach
        @if(isset($options->country))
            <tr>
                <td>Страна</td>
                <td>{{$options->country}}</td>
            </tr>
        @endif
    </tbody>
</table>
