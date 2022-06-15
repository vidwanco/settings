<label @if($for) for="{{ $for }}" @endif
    {{-- Attributes --}}
    @foreach ($attributes as $key => $attribute)
        @php $additionalAttributes = ''; @endphp
        @isset($attributesFor[$for][$key])
            @php
                $additionalAttributes = Arr::pull($attributesFor[$for], $key);
            @endphp
        @endisset
        {{$key}}{!! '="' !!}{{$attribute}} {{$additionalAttributes}}{!!'"'!!}
    @endforeach
    @isset($attributesFor[$for])
        @foreach ($attributesFor[$for] as $key => $attribute)
            {{$key}}{!! '="' !!}{{$attribute}}{!!'"'!!}
        @endforeach
    @endisset
>
    {{ Str::title($setting->name) }}
</label>
