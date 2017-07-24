@extends('admin.core')
@section('content')
    <div class="container">
        <div class="horizontal">
            <div id="pages_title">
                <h1 style="text-align: center;">{{$title}} </h1>
            </div>
            <div class="col-xs-12 col-md-4">
                <img class="imgAdmin" src="{{$path}}">
            </div>
            @foreach($files as $key => $value)
                @foreach($value['files'] as $path)
                    <div class="col-xs-6 col-md-2" style="margin-left: 30px;">
                        <div id={{$path['id']}}>
                            <img src="{{$path['path']}}" height="120" width="150" style="border-radius: 90%";>
                            {{--{{Form::label('delete')}}--}}
                            {{--{{Form::checkbox($path['id'])}}--}}
                            <button onclick="deleteItem( '{{ route($delete,$path['id']) }}')"
                                    class="btn btn-danger" style="margin: 10px 40px">{{ trans('app.delete')}}</button>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
    <div class="col-xs-6 col-md-4">
        <h4>{{$description_short}}</h4>
        <h4>{{$description_long}}</h4>
        <a class="btn btn-primary" href="{{$back}}">{{ trans('app.back') }}</a>
        <a class="btn btn-success" href="{{$edit}}">{{ trans('app.edit') }}</a>
    </div>
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