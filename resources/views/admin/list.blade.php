@extends('admin.core')
@section('content')
    <div class="container">
        <div id="list">
            @if(sizeof($list)>0)
                <h2>{{$tableName}}</h2>
                <table class="table table-condensed">
                    <tr>
                        @foreach($list[0] as $key => $value)
                            <th>{{$key}}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach($list as $record)
                            @foreach($record as $key=> $value)
                                @if($key == 'is_active')
                                    <td>
                                        @if($value == 1)
                                            <button onclick="enableaDisbaleLanguage( {{route($callToAction, $record['id']), 0}} )"
                                                    type="button"
                                                    class="btn btn-primary">{{ trans('app.disable') }}</button>
                                            <button onclick="enableaDisbaleLanguage( {{route($callToAction, $record['id']), 1}} )"
                                                    type="button" style="display: none"
                                                    class="btn btn-success">{{ trans('app.active') }}</button>
                                        @else
                                            <button onclick="enableaDisbaleLanguage( {{route($callToAction, $record['id']), 1}} )"
                                                    type="button"
                                                    class="btn btn-success">{{ trans('app.active') }}</button>
                                            <button onclick="enableaDisbaleLanguage( {{route($callToAction, $record['id']), 0}} )"
                                                    type="button" style="display: none"
                                                    class="btn btn-primary">{{ trans('app.disable') }}</button>
                                        @endif
                                    </td>
                                @else
                                    <td>{{$value}}</td>
                                @endif
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

@section('scripts')
    <script>
        function enableaDisbaleLanguage(url, value) {

        }


    </script>
@endsection