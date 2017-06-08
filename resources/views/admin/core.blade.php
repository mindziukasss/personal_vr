<!DOCTYPE html>

<html lang="en">
<head>
    @include('admin.style')

    <meta name="csrf-token" content="{{ csrf_token() }}"/>

</head>

<body>
    @include('admin.nav')
    @yield('content')

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</html>
