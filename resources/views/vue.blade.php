<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/vue.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @if(!session('theme') || session('theme') == 'light')
        <link href="{{ mix('css/light.css') }}" rel="stylesheet">
    @elseif(session('theme') == 'dark')
        <link href="{{ mix('css/dark.css') }}" rel="stylesheet">
    @endif
    <script>
        window.Laravel = <?php echo json_encode([
            'currentUser' => Auth::check() ? App\User::with(['roles'])->find(Auth::user()->id) : null,
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        @auth
            @include('layouts.admin_nav')
        @endauth

        <router-view class="container" :key="$route.fullPath"></router-view>
    </div>
    @auth
        <script src="https://www.danielljungqvist.se/ckeditor/ckeditor.js"></script>
    @endauth
    <!-- Scripts -->
    <script src="{{ mix('js/vue.js') }}"></script>
    <script src="{{ mix('js/code.js') }}"></script>
</body>
</html>
