@php
    $default = !empty($setting->default) ? explode(',', $setting->default) : [];
@endphp
@foreach ($setting->options as $keyID => $value)
    @php
        $additionalAttributes = $attributesFor[$type] ?? [];
    @endphp
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
                @isset($additionalAttributes[$key])
                    @php
                        $additionalAttributesValue = Arr::pull($additionalAttributes, $key);
                    @endphp
                @endisset
                {{$key}}{!! '="' !!}{{$attribute}} {{$additionalAttributesValue}}{!!'"'!!}
            @endforeach
            @isset($additionalAttributes)
                @foreach ($additionalAttributes as $key => $attribute)
                    {{$key}}{!! '="' !!}{{$attribute}}{!!'"'!!}
                @endforeach
            @endisset
        />
        <label for="{{$keyID}}"
            @isset($attributesFor['innerLabel'][$type])
                @foreach ($attributesFor['innerLabel'][$type] as $key => $attribute)
                    {{$key}}{!! '="' !!}{{$attribute}}{!!'"'!!}
                @endforeach
            @endisset
        >{{ Str::title($value) }}</label>
    </div>
@endforeach
