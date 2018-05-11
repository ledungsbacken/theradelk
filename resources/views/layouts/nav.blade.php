<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="/">{{ config('app.name', 'Laravel') }}</a>
        </div>
        <!-- <nav-categories></nav-categories> -->
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
                <li><a href="/post">Posts</a></li>
                <li><a href="/login">Login</a></li>
                @if(!session('theme') || session('theme') == 'light')
                    <li><a href="/theme/set/dark">Dark</a></li>
                @elseif(session('theme') == 'dark')
                    <li><a href="/theme/set/light">Light</a></li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li><search string="{{ app('request')->q ? app('request')->q : '' }}"></search></li>
            </ul>
        </div>
    </div>
</nav>
