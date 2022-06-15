<textarea
    name="{{ $setting->key }}"
    type="{{ $type }}"
    @if($id) id="{{ $id }}" @endif
    {{-- Attributes --}}
    @foreach ($attributes as $key => $attribute)
        @php $additionalAttributes = ''; @endphp
        @isset($attributesFor[$type][$key])
            @php
                $additionalAttributes = Arr::pull($attributesFor[$type], $key);
            @endphp
        @endisset
        {{$key}}{!! '="' !!}{{$attribute}} {{$additionalAttributes}}{!!'"'!!}
    @endforeach
    @isset($attributesFor[$type])
        @foreach ($attributesFor[$type] as $key => $attribute)
            {{$key}}{!! '="' !!}{{$attribute}}{!!'"'!!}
        @endforeach
    @endisset
>{{ old($setting->key, $setting->default) }}</textarea>

