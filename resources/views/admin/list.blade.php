@extends('admin.core')
@section('content')

    <div>
        <h2>{{$tableName}}</h2>
    </div>
    <div>
        @if(isset($create))
            <a class="btn btn-success" href="{{route($create)}}">{{ trans('app.newRecord') }}</a>
    </div>
    @endif

    @if(sizeof($list)>0)
        <table class="table table-condensed">
            <tr>
                @foreach($list[0] as $key => $value)
                    <th>{{$key}}</th>
                @endforeach
                @if(isset($edit))
                    <th>Edit</th>
                @endif

                @if(isset($delete))
                    <th>Delete</th>
                @endif

            </tr>
            @foreach($list as $record)
                <tr id="{{$record['id']}}">

                    @foreach($record as $key=> $value)
                        @if($key == 'is_active')
                            <td>
                                @if($value == 1)
                                    <button onclick="toggleActive( '{{route($callToAction, $record['id'])}}', 0)"
                                            type="button"
                                            class="btn btn-primary">{{ trans('app.disable') }}
                                    </button>

                                    <button onclick="toggleActive( '{{route($callToAction, $record['id'])}}', 1 )"
                                            type="button" style="display: none"
                                            class="btn btn-success">{{ trans('app.active') }}
                                    </button>
                                @else
                                    <button onclick="toggleActive( '{{route($callToAction, $record['id'])}}', 1 )"
                                            type="button"
                                            class="btn btn-success">{{ trans('app.active') }}
                                    </button>
                                    <button onclick="toggleActive( '{{route($callToAction, $record['id'])}}', 0 )"
                                            type="button" style="display: none"
                                            class="btn btn-primary">{{ trans('app.disable') }}</button>
                                @endif
                            </td>


                        @elseif($key == 'translation')
                            @if(isset($value['title']))
                                <td>{{$value['title'] . ' ' . $value['language_code']}}</td>
                            @else
                                <td>{{$value['name'] . ' ' . $value['language_code']}}</td>
                            @endif
                        @else
                            <td>{{$value}}</td>
                        @endif

                    @endforeach

                    @if(isset($edit) )
                        <td><a href="{{route($edit,$record['id'])}}">
                                <button type="button" class="btn btn-primary">{{  trans('app.edit')}}</button>
                            </a></td>
                    @endif

                    @if(isset($edit) )
                        <td>
                            <button onclick="deleteItem( '{{ route($delete, $record['id']) }}' )"
                                    class="btn btn-danger">{{ trans('app.delete')}}</button>
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>
    @else
        <h2>{{ trans('app.no_data') }}</h2>
    @endif
@endsection


@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function toggleActive(url, value) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    is_active: value
                },
                success: function (response) {
                    var $primary = $('#' + response.id).find('.btn-primary')
                    var $success = $('#' + response.id).find('.btn-success')
                    if (response.is_active === '1') {
                        $success.hide();
                        $primary.show();
                    }
                    else {
                        $success.show();
                        $primary.hide();
                    }
                }
            });
        }

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