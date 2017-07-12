@extends('admin.core')
@section('content')

{{--    {!! Form::open(['url' => route('app.resources.create', $VRPages->id), 'files' => true]) !!}--}}
    {{--{!! Form::open(['url' => 'app.resources.create', $VRPages, 'files' => true]) !!}--}}

{!! Form::open(['route' => array('app.resources.create', $VRPages->id), 'files' => true]) !!}

    <label class="btn btn-primary btn-sm btn-file">
        <i class="fa fa-upload fm-sm" aria-hidden="true"></i> Create new resource
        <input type="file" multiple onchange="this.form.submit()" name="files[]" hidden>
    </label>

    {!! Form::close() !!}

@endsection

