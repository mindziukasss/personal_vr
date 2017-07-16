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
                <div id={{$path['id']}}>
                    <img src="{{$path['path']}}" height="150" width="200">
                    <div class="form-group">
                        {{--{{Form::label('delete')}}--}}
                        {{--{{Form::checkbox($path['id'])}}--}}
                        <button onclick="deleteItem( '{{ route($delete,$path['id']) }}')"
                                class="btn btn-danger">{{ trans('app.delete')}}</button>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
    <a class="btn btn-primary" href="{{$back}}">{{ trans('app.back') }}</a>
    <a class="btn btn-success" href="{{$edit}}">{{ trans('app.edit') }}</a>
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function deleteItem(route) {
            $.ajax({
                url: route,
                type: 'DELETE',
                dataType: 'json',
            success: function (response) {
                $('#' + response.id).remove();
                },
                error: function () {
                    alert('ERROR')
                }
            });
        }

    </script>
@endsection