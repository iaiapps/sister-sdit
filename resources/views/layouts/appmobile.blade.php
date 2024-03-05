<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- css -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    @stack('css')
</head>

<body>

    <!-- background -->
    <div class="background position-absolute top-0"></div>

    <!-- content -->
    <main class="p-3">
        @include('layouts.partials.title')
        @yield('content')

        <!-- footer -->
        @include('layouts.partials.footer')
    </main>

    <!-- script -->
    <script src="{{ asset('assets/jquery/jquery-3.6.4.min.js') }}"></script>
    @stack('scripts')
</body>

</html>
