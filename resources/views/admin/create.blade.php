@extends('admin.core')
@section('content')
    <h2>{{trans('app.new_record')}}{{$titleForm}}</h2>

    {!! Form::open(['url' => $route]) !!}

        @foreach($fields as $field)

            @if($field['type'] == 'drop_down')

                <div class="form-group">
                    {{ Form::label(trans('app.select') )}}
                    {{Form::select($field['key'],$field['options'])}}
                </div>

            @elseif($field['type'] == 'single_line')

                <div class="form-group">
                    {{ Form::label($field['key'], trans('app.' . $field['key'])) }}
                    {{ Form::text($field['key'])}}
                </div>

            @elseif($field['type'] == 'check_box')

                <div class="form-group">
                    {{ Form::label($field['key'], trans('app.' . $field['key'])) }}
                    {{Form::checkbox('key', 'value')}}
                </div>

            @endif

        @endforeach

    <a class="btn btn-primary" href="{{route($back)}}">{{ trans('app.back') }}</a>

    {{Form::submit(trans('app.save'), array('class' => 'btn btn-success')) }}

    {!!Form::close()!!}
@endsection