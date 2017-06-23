<div>
    <ul class="nav navbar-nav">
        @foreach( $menu as $record)
            @if (sizeof($record['submenu'])>0)
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">{{($record['translation']['name'])}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @foreach($record['submenu'] as $element)
                            <li><a href="{{$element['translation']['url']}}">{{$element['translation']['name']}}</a></li>
                        @endforeach
                    </ul>
            @else
                <li class="active"><a href="{{$record['translation']['url']}}"> {{$record['translation']['name']}}
                        <span class="sr-only">(current)</span></a></li>

                </li>
            @endif
        @endforeach
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">{{trans('app.languages')}}<span class="caret"></span></a>
                <ul class="dropdown-menu">

                    @foreach($lang_menu as $key => $value)
                        <li><a href="?language_code={{($key)}}">{{($value)}}</a></li>
                    @endforeach
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">{{trans('app.rooms')}}<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    @foreach($rooms as $value)
                        <li><a href=" /{{app()->getLocale(). '/pages/' . ($value['translation']['slug'])}}">{{($value['translation']['title'])}}</a></li>
                    @endforeach
                </ul>
            </li>
    </ul>
</div>

