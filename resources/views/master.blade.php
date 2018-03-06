<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @if(!session('theme') || session('theme') == 'light')
        <link href="{{ mix('css/light.css') }}" rel="stylesheet">
    @elseif(session('theme') == 'dark')
        <link href="{{ mix('css/dark.css') }}" rel="stylesheet">
    @endif
</head>
<body>
    <div id="app">
        @auth
            @include('layouts.admin_nav')
        @endauth
        @include('layouts.nav')
        <div class="container">
            @yield('content')
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
