<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('user.style')

    <title>@yield('title')</title>
</head>


<body>
@include('user.menu')
{{--<div id="id-menu">--}}
{{--</div>--}}
<div id="page">
    @yield('content')
</div>



</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>
