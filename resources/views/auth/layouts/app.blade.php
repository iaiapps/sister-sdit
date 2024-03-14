<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') | {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/iconn.png') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- css -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

    @stack('css')

</head>

<body class="bg-light">
    <!-- header -->

    <!-- content -->
    @yield('content')

    <!-- footer -->

    <!-- script -->
    @stack('scripts')
</body>

</html>
