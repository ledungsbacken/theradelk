<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title><?php echo (isset($title)) ? $title : 'TheRadElk' ?></title>

    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    @stack('meta')

    @guest
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90622404-4"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-90622404-4');
    </script>
    @endguest

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
            @include('layouts.subTopper')
            @yield('content')

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/code.js') }}"></script>
</body>
</html>
