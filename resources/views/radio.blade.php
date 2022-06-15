
@foreach ($setting->options as $keyID => $value)
    <div
        @isset($attributesFor[$type]['innerBlock'])
            @foreach ($attributesFor[$type]['innerBlock'] as $key => $attribute)
                {{$key}}{!! '="' !!}{{$attribute}}{!!'"'!!}
            @endforeach
        @endisset
    >
        <input
            name="{{ $setting->key }}[]"
            type="{{ $type }}"
            id="{{ $keyID }}"
            value="{{ $keyID }}"
            {{ old($setting->key, $setting->default) == $keyID ? 'checked' : '' }}
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
        />
        <label for="{{$keyID}}">{{ Str::title($value) }}</label>
    </div>
@endforeach
