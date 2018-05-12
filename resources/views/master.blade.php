<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title><?php echo (isset($title)) ? $title : 'TheRadElk' ?></title>

    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
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

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-6325527014785647",
        enable_page_level_ads: true
      });
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title><?php echo (isset($title)) ? $title : config('app.name', 'Laravel') ?></title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @if(!session('theme') || session('theme') == 'light')
        <link href="{{ mix('css/light.css') }}" rel="stylesheet">
    @elseif(session('theme') == 'dark')
        <link href="{{ mix('css/dark.css') }}" rel="stylesheet">
    @endif
</head>
<body>
    <div>
        @auth
            @include('layouts.admin_nav')
        @endauth
        @include('layouts.topper')
        @yield('content')
        @include('layouts.footer')
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/code.js') }}"></script>
    @stack('script')
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
</body>
</html>
