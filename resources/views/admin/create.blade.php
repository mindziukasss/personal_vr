@extends('admin.core')
@section('content')
    <h2>{{trans('app.new_record')}}{{$titleForm}}</h2>

    {!! Form::open(['url' => $route]) !!}

    @foreach($fields as $field)
        @if(!($field['type'] == 'check_box'))
            {{ Form::label($field['key'], trans('app.' . $field['key'])) }}
        @endif

        @if($field['type'] == 'drop_down')
            @if($field['key'] == 'language_code')

                <div class="form-group">
                    {{Form::select($field['key'],$field['options'])}}
                </div>
            @else
                <div class="form-group">
                    {{Form::select($field['key'],$field['options'], null, ['placeholder' => ''] ) }}
                </div>
            @endif

        @elseif($field['type'] == 'single_line')

            <div class="form-group">
                {{ Form::text($field['key'])}}
            </div>

        @elseif($field['type'] == 'check_box')

            @foreach($field['options'] as $option)
                <div class="form-group">
                    {{Form::label($option['title'])}}
                    {{Form::checkbox($option['name'],$option['value'])}}
                </div>
            @endforeach

        @endif

    @endforeach

    <a class="btn btn-primary" href="{{route($back)}}">{{ trans('app.back') }}</a>

    {{Form::submit(trans('app.save'), array('class' => 'btn btn-success')) }}

    {!!Form::close()!!}
@endsection
@section('scripts')
    <script>
        $('#language_code').bind(
            'change', function () {
                window.location.href = "?language_code=" + $('#language_code').val();

            }
        )

    </script>
@endsection
