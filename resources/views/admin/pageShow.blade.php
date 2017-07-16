@extends('admin.core')
@section('content')

    <div id="pages_title">
        {{$title}}
    </div>
    <div>
        <img src="{{$path}}" height="25" width="30">
    </div>
    <h1>{{$description_short}}</h1>
    <h4>{{$description_long}}</h4>
    <div>
        @foreach($files as $key => $value)
            @foreach($value['files'] as $path)
                <img src="{{$path['path']}}" height="150" width="200">
            @endforeach
        @endforeach
    </div>
    <a class="btn btn-primary" href="{{$back}}">{{ trans('app.back') }}</a>
    <a class="btn btn-success" href="{{$edit}}">{{ trans('app.edit') }}</a>


@endsection