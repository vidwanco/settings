<button type="{{ $type }}"
        {{-- Attributes --}}
        @foreach ($attributes as $key => $attribute)
            {{-- Merge same attribute keys --}}
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
>
{!! $attributesFor['button']['icon'] ?? '' !!} {{$attributesFor['button']['text'] ?? 'Submit'}}
</button>
