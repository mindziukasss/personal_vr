<!DOCTYPE html>

<html lang="en">
<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.style')


</head>

<body>
    @include('admin.nav')
    <div class="container">
        @yield('content')
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@yield('scripts')
</html>
