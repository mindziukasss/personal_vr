@extends('admin.core')
@section('content')
<div class="container">
    <div id="list">
        @if(sizeof($list)>0)
            <table class="table table-hover">
                <tr>
                    @foreach($list[0] as $key => $value)
                        <th>{{$key}}</th>
                    @endforeach
                </tr>
                <tr>
                    @foreach($list as $record)
                        @foreach($record as $value)
                            <td>{{$value}}</td>
                        @endforeach
                </tr>
                @endforeach
            </table>
        @else
            <h1>{{ trans('app.no_data') }}</h1>
        @endif
    </div>
</div>
@endsection