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
        @include('layouts.nav')

        <router-view class="container"></router-view>
    </div>

    <!-- Scripts -->
    @auth
        <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    @endauth
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
