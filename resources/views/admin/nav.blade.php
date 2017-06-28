<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav navbar-right">
      @if (Auth::guest())
        {{-- //TODO create link to user --}}
      @else
        @foreach (getActiveLanguages() as $key => $value)
          <li><a href="?language_code={{($key)}}">{{($value)}}</a></li>
        @endforeach
        <li>
          <a href="{{ route('app.users.index') }}"><span class="glyphicon glyphicon-user"></span>{{ Auth::user()->name }}</a>
        </li>
        <li>
          <a href="{{ route('logout') }}"onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <span class="glyphicon glyphicon-log-in"></span> Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}
          </form>
        </li>
      @endif
    </ul>
  </div>
</nav>

