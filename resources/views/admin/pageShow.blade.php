@extends('admin.core')
@section('content')

    <div id="pages_title">
        {{$title}}
    </div>
    <div>
        <img src="{{$path}}">
    </div>
    <h1>{{$description_short}}</h1>
    <h4>{{$description_long}}</h4>

    <a class="btn btn-primary" href="{{$back}}">{{ trans('app.back') }}</a>
    <a class="btn btn-success" href="{{$edit}}">{{ trans('app.edit') }}</a>


@endsection