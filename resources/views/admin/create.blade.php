@extends('admin.core')
@section('content')

{{--{{dd($fields)}};--}}
    {!! Form::open(['url' => route($create)]) !!}

        @foreach($fields as $field)

            @if($field['type'] == 'drop_down')
                {{Form::select($field['key'],$field['options'])}}

            @else
                {{ Form::text($field['key'])}}

                @endif

            @endforeach
    {{Form::submit('Submit!')}}
    {!!Form::close()!!}

@endsection