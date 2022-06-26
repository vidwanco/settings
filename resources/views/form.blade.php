<form method="{{ $method !== 'GET' ? 'POST' : 'GET' }}"
    @empty($action)@else action="{{ $action }}" @endempty
    {!! $uploadable ? 'enctype="multipart/form-data"' : '' !!}
    @foreach ($form as $key => $value)
        {{$key}}{!! '="' !!}{{$value}}{!! '"' !!}
    @endforeach
>
    @csrf
    @if($method) @method($method) @endif

    @foreach ($settings as $setting)

        @can($setting->permission)

            @php
                $invalidClass = $errors->has($setting->key) ? ($attributesFor["is-invalid"]['input'] ?? "") : "";
                $input['class'] = isset($input['class']) ? $input['class'].' '.$invalidClass : $invalidClass;
            @endphp

            <div
                @foreach ($block as $key => $value)
                    {{$key}}{!! '="' !!}{{$value}}{!! '"' !!}
                @endforeach
            >
                {!! $setting->formLabel($label, $attributesFor) !!}
                {!! $setting->formInput($input, $attributesFor) !!}
                @error($setting->key)
                    <span
                        @if(isset($attributesFor["is-invalid"]['message']) && is_array($attributesFor["is-invalid"]['message']))
                            @foreach ($attributesFor["is-invalid"]['message'] as $messageKey => $messageAttributes)
                                {{$messageKey}}{!! '="' !!}{{$messageAttributes}}{!! '"' !!}
                            @endforeach
                        @endif
                    >
                        <strong>
                            @isset($attributesFor['is-invalid']['icon'])
                                @svg($attributesFor['is-invalid']['icon'], $attributesFor['is-invalid']['icon_class'] ?? '')
                            @endisset
                            {{ $message }}
                        </strong>
                    </span>
                @enderror
            </div>

        @endcan

    @endforeach

    {!! \Vidwan\Settings\Settings::button($buttonType, $button, $attributesFor) !!}

</form>
