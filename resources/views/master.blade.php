<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    @stack('meta')

    @auth
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90622404-4"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-90622404-4');
    </script>
    @endauth

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @if(!session('theme') || session('theme') == 'light')
        <link href="{{ mix('css/light.css') }}" rel="stylesheet">
    @elseif(session('theme') == 'dark')
        <link href="{{ mix('css/dark.css') }}" rel="stylesheet">
    @endif
</head>
<body>
        @auth
            @include('layouts.admin_nav')
        @endauth
            @include('layouts.topper')
            @yield('content')

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
