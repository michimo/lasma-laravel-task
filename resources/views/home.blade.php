<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Styles & Scripts -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.0/dist/index.umd.min.js"></script>
        <script src="{{ asset('assets/js/app.min.js') }}" defer></script>
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
        <!-- {{-- @vite(['resources/css/app.min.css', 'resources/js/app.min.js']) --}} -->

    </head>
    <body class="antialiased">

        <div class="container w-50 my-5">

            @yield('content')

        </div>

            @yield('datepicker')

    </body>
</html>
