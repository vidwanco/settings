@php
    $default = !empty($setting->default) ? explode(',', $setting->default) : [];
@endphp
@foreach ($setting->options as $keyID => $value)
    <div
        @isset($attributesFor['innerBlock'][$type])
            @foreach ($attributesFor['innerBlock'][$type] as $key => $attribute)
                {{$key}}{!! '="' !!}{{$attribute}}{!!'"'!!}
            @endforeach
        @endisset
    >
        <input
            name="{{ $setting->key }}[]"
            type="{{ $type }}"
            id="{{ $keyID }}"
            value="{{ $keyID }}"
            {{ in_array(old($setting->key), $default) ? 'checked' : '' }}
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