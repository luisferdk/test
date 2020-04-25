<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>@yield('title','App')</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
        @yield('css')
    </head>

    <body>
        @yield('content')
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
        @yield('js')
    </body>

</html>
