<div id="topper_padding">
    <h1>COME'N'GEEK</h1>
</div>
<div id="topcolWrap">
    <div id="topper">
        <i class="fas fa-bars" id="mobile"></i>
        <nav id="categories">
        <ul class="inline">
            @foreach(App\Category::get() as $category)
                <li><a href="/category/{{ $category->slug }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
        </nav>
        <a href="/">
            <img src="https://theradelk.com/logo-realSize.png" id="logo" alt="">
        </a>
        <nav id="core" class="inline">
            <ul>
                <li><a href="/about">about</a></li>
                <li><a href="/contact">contact</a></li>
                <li><a href="/join">join us</a></li>
            </ul>
            <ul id="social">
                <li><a target="_blank" href="https://www.facebook.com/theradelk/"><i class="fab fa-facebook-f"></i></a></li>
                <li><a target="_blank" href="https://twitter.com/theradelk"><i class="fab fa-twitter"></i></a></li>
                <li><a target="_blank" href="https://www.instagram.com/theradelk"><i class="fab fa-instagram"></i></a></li>
                <li><a target="_blank" href="https://www.snapchat.com/add/theradelk"><i class="fab fa-snapchat"></i></a></li>
                <li><a target="_blank" href="https://discordapp.com/invite/yNAWDcv"><i class="fab fa-discord"></i></a></li>
            </ul>
            <ul id="switch">
                @if(!session('theme') || session('theme') == 'light')
                    <li>
                        <a href="/theme/set/dark">
                            <span>DARK</span>
                            <i class="fa fa-toggle-off"></i>
                        </a>
                    </li>
                @elseif(session('theme') == 'dark')
                    <li>
                        <a href="/theme/set/light">
                            <span>DARK</span>
                            <i class="fa fa-toggle-on"></i>
                        </a>
                    </li>
                @endif
            </ul>
            <ul>
                <li>
                    <i class="fas fa-search" id="searchToggle"></i>
                </li>
            </ul>
        </nav>
    </div>
</div>
<div id="searchField">
    <div class="wrapper">
        <div id="app">
            <search string="{{ app('request')->q ? app('request')->q : '' }}"></search>
        </div>
    </div>
</div>
<nav id="mobile_nav">
    <ul>
        @foreach(App\Category::get() as $category)
            <li><a href="/category/{{ $category->slug }}">{{ $category->name }}</a></li>
        @endforeach
    </ul>
    <ul id="switch">
        @if(!session('theme') || session('theme') == 'light')
            <li><a href="/theme/set/dark">
                <span>DARK</span>
                <i class="fas fa-toggle-off"></i>
            </a></li>
        @elseif(session('theme') == 'dark')
            <li><a href="/theme/set/light">
                <span>DARK</span>
                <i class="fas fa-toggle-on"></i>
            </a></li>
        @endif
    </ul>
    <ul>
        <li><a href="/about-us">about</a></li>
        <li><a href="/contact">contact</a></li>
        <li><a href="/join-us">join us</a></li>
    </ul>
    <ul>
        <li><a target="_blank" href="https://www.facebook.com/theradelk/"><i class="fab fa-facebook-f"></i></a></li>
        <li><a target="_blank" href="https://twitter.com/theradelk"><i class="fab fa-twitter"></i></a></li>
        <li><a target="_blank" href="https://www.instagram.com/theradelk"><i class="fab fa-instagram"></i></a></li>
        <li><a target="_blank" href="https://www.snapchat.com/add/theradelk"><i class="fab fa-snapchat"></i></a></li>
        <li><a target="_blank" href="https://www.snapchat.com/theradelk"><i class="fab fa-linkedin"></i></a></li>
        <li><a target="_blank" href="https://discordapp.com/invite/yNAWDcv"><i class="fab fa-discord"></i></a></li>
    </ul>
</nav>
<div id="scrollFollow_nav">
    <h1><a href="http://theradelk.com">theRadElk</a></h1>
    <i class="fas fa-bars" id="scrollFollowToggle"></i>
    <nav id="categories">
        <ul class="inline">
            @foreach(App\Category::get() as $category)
                <li><a href="/category/{{ $category->slug }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </nav>
    <nav id="social">
        <ul class="inline">
            <li><a href="https://www.facebook.com/theradelk/"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="https://twitter.com/theradelk"><i class="fab fa-twitter"></i></a></li>
            <li><a href="https://www.instagram.com/theradelk"><i class="fab fa-instagram"></i></a></li>
            <li><a href="https://www.snapchat.com/theradelk"><i class="fab fa-snapchat"></i></a></li>
            <li><a href="https://www.snapchat.com/theradelk"><i class="fab fa-linkedin"></i></a></li>
            <li><a href="https://www.snapchat.com/theradelk"><i class="fab fa-discord"></i></a></li>
        </ul>
    </nav>
</div>
