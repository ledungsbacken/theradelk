<nav class="navbar navbar-default navbar-static-top" style="z-index:1001;">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">{{ Auth::user()->name }}</a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav">
                &nbsp;
                <li><a href="/admin#/post">See all posts</a></li>
                <li><a href="/admin#/create/post">Create Post</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="/admin#/file/upload">Upload Head Images</a></li>
            @can('view', App\User::class)
                <li><a href="/admin#/user">Users</a></li>
            @endcan
            @if(App\User::find(Auth::user()->id)->hasPermission('full'))
                <li><a href="/admin#/category">Categories</a></li>
            @endif
                <li><a href="/admin#/profile">Edit account</a></li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
