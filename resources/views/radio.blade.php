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
            {{ old($setting->key, $setting->default) == $keyID ? 'checked' : '' }}
            {{-- Attributes --}}
            @foreach ($attributes as $key => $attribute)
                @isset($additionalAttributes[$key])
                    @php
                        $additionalAttributes = Arr::pull($additionalAttributes, $key);
                    @endphp
                @endisset
                {{$key}}{!! '="' !!}{{$attribute}} {{$additionalAttributes}}{!!'"'!!}
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
