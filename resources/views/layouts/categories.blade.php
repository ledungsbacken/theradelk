<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <!-- <nav-categories></nav-categories> -->
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
                @foreach(App\Category::get() as $category)
                    <li><a href="/category/{{ $category->slug }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
