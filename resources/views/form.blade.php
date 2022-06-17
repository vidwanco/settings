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
            <div
                @foreach ($block as $key => $value)
                    {{$key}}{!! '="' !!}{{$value}}{!! '"' !!}
                @endforeach
            >
                {!! $setting->formLabel($label, $attributesFor) !!}
                {!! $setting->formInput($input, $attributesFor) !!}
            </div>
        @endcan

    @endforeach

    {!! \Vidwan\Settings\Settings::button($buttonType, $button, $attributesFor) !!}

</form>
