<div class="wrapper">
<div id="topcolWrap">
    <div id="topper">
        <i class="fa fa-bars" id="mobile"></i>
        <nav id="categories">
        <ul class="inline">
            <li>
                <a href="/">latest</a>
            </li>
            @foreach(App\Category::get() as $category)
                <li><a href="/category/{{ $category->slug }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
        </nav>
        <img src="http://theradelk-server.test/logo-realSize.PNG" id="logo" alt="">
        <nav id="core" class="inline">
            <ul>
                <li>about</li>
                <li>contact</li>
                <li>join us</li>
            </ul>
            <ul id="switch">
            @if(!session('theme') || session('theme') == 'light')
                <li><a href="/theme/set/dark">
                    <span>DARK</span>
                    <i class="fa fa-toggle-off"></i>
                </a></li>
                @elseif(session('theme') == 'dark')
                <li><a href="/theme/set/light">
                    <span>DARK</span>
                    <i class="fa fa-toggle-on"></i>
                </a></li>
            @endif
            </ul>
            <ul id="social">
            <li><a href="https://www.facebook.com/theradelk/"><i class="fa fa-facebook"></i></a></li>
            <li><a href="https://twitter.com/theradelk"><i class="fa fa-twitter"></i></a></li>
            <li><a href="https://www.instagram.com/theradelk"><i class="fa fa-instagram"></i></a></li>
            <li><a href="https://www.snapchat.com/theradelk"><i class="fa fa-snapchat"></i></a></li>
            <li><a href="https://www.snapchat.com/theradelk"><i class="fa fa-linkedin"></i></a></li>
            </ul>
        </nav>
    </div>
    <nav id="mobile_nav">
        <ul>
            <li>
                <a href="/">latest</a>
            </li>
            @foreach(App\Category::get() as $category)
                <li><a href="/category/{{ $category->slug }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
        <ul id="switch">
        @if(!session('theme') || session('theme') == 'light')
            <li><a href="/theme/set/dark">
                <span>DARK</span>
                <i class="fa fa-toggle-off"></i>
            </a></li>
            @elseif(session('theme') == 'dark')
            <li><a href="/theme/set/light">
                <span>DARK</span>
                <i class="fa fa-toggle-on"></i>
            </a></li>
        @endif
        </ul>
        <ul>
            <li>about</li>
            <li>contact</li>
            <li>join us</li>
        </ul>
        <ul>
            <li><a href="https://www.facebook.com/theradelk/"><i class="fa fa-facebook"></i></a></li>
            <li><a href="https://twitter.com/theradelk"><i class="fa fa-twitter"></i></a></li>
            <li><a href="https://www.instagram.com/theradelk"><i class="fa fa-instagram"></i></a></li>
            <li><a href="https://www.snapchat.com/theradelk"><i class="fa fa-snapchat"></i></a></li>
            <li><a href="https://www.snapchat.com/theradelk"><i class="fa fa-linkedin"></i></a></li>
        </ul>
    </nav>
</div>
</div>