@extends('master')
@section('content')
    <div id="startPage">
        @if($scenery->firstPost && $scenery->secondPost && $scenery->thirdPost)
        <section id="collage">
            <div class="item large">
                <a href="/post/{{ $scenery->firstPost->slug }}" class="stories"></a>
                    <div class="hoverLayer">
                        <picture>
                            <source media="(max-width:800px)" srcset="{{ $scenery->firstPost->headImage->phone }}">
                            <source media="(min-width:801px)" srcset="{{ $scenery->firstPost->headImage->tablet }}">
                            <img src="{{ $scenery->firstPost->headImage->phone }}" alt="">
                        </picture>
                        <div class="underLay">
                            <header>
                                <h2>{{ $scenery->firstPost->title }}</h2>
                                <span>
                                    {{ $scenery->firstPost->subtitle }}
                                </span>
                                <p>
                                    by 
                                    <strong>
                                        <a href="/user/{{ $scenery->firstPost->user->id }}">{{ $scenery->firstPost->user->name }}</a>
                                    </strong>
                                </p>
                            </header>
                        </div>
                    </div>
            </div>
            <div class="item small">
                <a href="/post/{{ $scenery->secondPost->slug }}" class="stories"></a>
                <div class="hoverLayer">
                    <picture>
                        <source media="(max-width:800px)" srcset="{{ $scenery->secondPost->headImage->phone }}">
                        <source media="(min-width:801px)" srcset="{{ $scenery->secondPost->headImage->tablet }}">
                        <img src="{{ $scenery->secondPost->headImage->phone }}" alt="">
                    </picture>
                </div>
                <header>
                    <h2>{{ $scenery->secondPost->title }}</h2>
                    <p>by <strong>{{ $scenery->secondPost->user->name }}</strong></p>
                </header>
            </div>
            <div class="item small">
                <a href="/post/{{ $scenery->thirdPost->slug }}" class="stories"></a>
                <div class="hoverLayer">
                    <picture>
                        <source media="(max-width:800px)" srcset="{{ $scenery->thirdPost->headImage->phone }}">
                        <source media="(min-width:801px)" srcset="{{ $scenery->thirdPost->headImage->tablet }}">
                        <img src="{{ $scenery->thirdPost->headImage->phone }}" alt="">
                    </picture>
                </div>
                <header>
                    <h2>{{ $scenery->thirdPost->title }}</h2>
                    <p>by <strong>{{ $scenery->thirdPost->user->name }}</strong>
                            </p>
                </header>
            </div>
        </section>
        @endif
        <section id="latest">
            <header class="placeholder">
                <h1 id="subtitle">
                    RECENT
                </h1>
                <a href="" class="loadmore">
                    <span>load more</span>
                    <i class="fas fa-chevron-right"></i>
                </a>
            </header>
            <main id="indexPosts">
                @each('includes.post', $posts, 'post')
            </main>
        </section>
        <section id="join_subscribe">
            <section id="join">
                <div class="icon">
                    <i class="fas fa-pencil-alt"></i>
                </div>
                <aside>
                    <header>
                        <h2>join our team</h2>
                        <p>
                            Got a passion for writing? we're looking for people
                            who wants to contribute to our site - no matter what
                            category you wanna write in!
                        </p>
                    </header>
                </aside>
            </section>
            <section id="subscribe">
                <div class="icon">
                    <i class="fas fa-envelope fa-rotate-45"></i>
                </div>
                <aside>
                    <header>
                        <h2>subscribe to our newsletter</h2>
                        <p>
                            Always stay up to date with that's going on here
                            at theradelk by subscribing to our newsletter!
                        </p>
                    </header>
                    <form action="">
                        <input type="text">
                        <i class="fas fa-arrow-right"></i>
                    </form>
                </aside>
            </section>
        </section>
        <section id="popular">
            <header class="placeholder">
                <h1 id="subtitle">
                    POPULAR RIGHT NOW
                </h1>
            </header>
            <main id="indexPosts">
                <article class="large">
                    <img src="http://theradelk-server.test/images/7dLRO8E8XYCWVy1SF6oK7SgMUTrqS3hLrTnIfRq3.jpeg" alt="">
                    <header>
                        <h1>Battlefield V just got its first trailer and more details before its fall launch</h1>
                        <p>
                            <a href="">Daniel Ljungqvist</a>
                            <span>
                                about 2 hours ago
                            </span>
                        </p>
                    </header>
                </article>
                <article class="middle">
                    <a href="google.com" class="large-link"></a>
                    <img src="http://www.theradelk.com/images/T3QKagxLNnp4Qusd6IaFDKcHbVsZE32weSnsJF9g.jpeg" alt="">
                    <header>
                        <h2>Snapchat has made it a lot easier for its members to understand their privacy policy</h2>
                        <p>
                            <a href="integoogle.com" class="author-link">Daniel Ljungqvist</a>
                            <span>
                                about 2 hours ago
                            </span>
                        </p>
                    </header>
                </article>
                <article class="middle">
                    <a href="" class="large-link"></a>
                    <img src="http://www.theradelk.com/images/HoZJNNq7CCZNCrULOiOrtrtCLP8MK78sYeFRA83O.jpeg" alt="">
                    <header>
                        <h2>Pornhub is bringing its own VPN services to the market</h2>
                        <p>
                            <a href="" class="author-link">Alexandru Chiric</a>
                            <span>
                                about 2 days ago
                            </span>
                        </p>
                    </header>
                </article>
                <article class="col">
                    <div class="hoverColors">
                        <a href="" class="posts">
                            <img src="https://theradelk.com/images/bbNdfh0mSHtEq54GdD7a9ntGpX3BTimdk4skq6lJ.jpeg" alt="">
                            <header>
                                <h2>
                                    YouTube brings direct messaging to desktop
                                </h2>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur.
                                </p>
                            </header>
                        </a>
                        <ul class="inline" id="laptop">
                            <li>
                            by <strong>
                                    <a href="">
                                        Daniel Ljungqvist
                                    </a>
                                </strong> in 
                                <strong>
                                    <a href="">
                                        Tech
                                    </a>
                                </strong>
                            </li>
                        </ul>
                        <ul class="inline" id="mobile">
                            <li>
                            by <strong>
                                    <a href="">
                                        Daniel Ljungqvist
                                    </a>
                                </strong> in 
                                <strong>
                                    <a href="">
                                        Tech
                                    </a>
                                </strong>
                            </li>
                        </ul>
                    </div>
                </article>
                <article class="col">
                    <div class="hoverColors">
                        <a href="" class="posts">
                            <img src="https://theradelk.com/images/unzwy8iuiSXS7tRDsXC515KAhPjqnNVoPAoJtDoP.jpeg" alt="">
                            <header>
                                <h2>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi aliquam, repellat amet.
                                </h2>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                </p>
                            </header>
                        </a>
                        <ul class="inline" id="laptop">
                            <li>
                            by <strong>
                                    <a href="">
                                        Daniel Ljungqvist
                                    </a>
                                </strong> in 
                                <strong>
                                    <a href="">
                                        Tech
                                    </a>
                                </strong>
                            </li>
                        </ul>
                        <ul class="inline" id="mobile">
                            <li>
                            by <strong>
                                    <a href="">
                                        Daniel Ljungqvist
                                    </a>
                                </strong> in 
                                <strong>
                                    <a href="">
                                        Tech
                                    </a>
                                </strong>
                            </li>
                        </ul>
                    </div>
                </article>
                <article class="col">
                    <div class="hoverColors">
                        <a href="" class="posts">
                            <img src="https://theradelk.com/images/phjxBdm3fBUqijKNIcsNQ27HseS5a6a8G3VSEjrz.jpeg" alt="">
                            <header>
                                <h2>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, ipsum?
                                </h2>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                </p>
                            </header>
                        </a>
                        <ul class="inline" id="laptop">
                            <li>
                            by <strong>
                                    <a href="">
                                        Daniel Ljungqvist
                                    </a>
                                </strong> in 
                                <strong>
                                    <a href="">
                                        Tech
                                    </a>
                                </strong>
                            </li>
                        </ul>
                        <ul class="inline" id="mobile">
                            <li>
                            by <strong>
                                    <a href="">
                                        Daniel Ljungqvist
                                    </a>
                                </strong> in 
                                <strong>
                                    <a href="">
                                        Tech
                                    </a>
                                </strong>
                            </li>
                        </ul>
                    </div>
                </article>
                <article class="col">
                    <div class="hoverColors">
                        <a href="" class="posts">
                            <img src="https://theradelk.com/images/fcsHE4XniqYwzLkjcvdOLwrtZBZY91dGxlTXYPLi.jpeg" alt="">
                            <header>
                                <h2>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse.
                                </h2>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur.
                                </p>
                            </header>
                        </a>
                        <ul class="inline" id="laptop">
                            <li>
                            by <strong>
                                    <a href="">
                                        Daniel Ljungqvist
                                    </a>
                                </strong> in 
                                <strong>
                                    <a href="">
                                        Tech
                                    </a>
                                </strong>
                            </li>
                        </ul>
                        <ul class="inline" id="mobile">
                            <li>
                            by <strong>
                                    <a href="">
                                        Daniel Ljungqvist
                                    </a>
                                </strong> in 
                                <strong>
                                    <a href="">
                                        Tech
                                    </a>
                                </strong>
                            </li>
                        </ul>
                    </div>
                </article>
                <article class="col">
                    <div class="hoverColors">
                        <a href="" class="posts">
                            <img src="https://theradelk.com/images/MJ0akMmhkysapUP0EG7pCegwVVnXDwoB1lOJcIB4.jpeg" alt="">
                            <header>
                                <h2>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                </h2>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt, molestiae!
                                </p>
                            </header>
                        </a>
                        <ul class="inline" id="laptop">
                            <li>
                            by <strong>
                                    <a href="">
                                        Daniel Ljungqvist
                                    </a>
                                </strong> in 
                                <strong>
                                    <a href="">
                                        Tech
                                    </a>
                                </strong>
                            </li>
                        </ul>
                        <ul class="inline" id="mobile">
                            <li>
                            by <strong>
                                    <a href="">
                                        Daniel Ljungqvist
                                    </a>
                                </strong> in 
                                <strong>
                                    <a href="">
                                        Tech
                                    </a>
                                </strong>
                            </li>
                        </ul>
                    </div>
                </article>
                <article class="col">
                    <div class="hoverColors">
                        <a href="" class="posts">
                            <img src="https://theradelk.com/images/kf4jHDijr7Mm5nCt0RCVKoYPfbpx7yzHDUXjAMwn.jpeg" alt="">
                            <header>
                                <h2>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi!
                                </h2>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                </p>
                            </header>
                        </a>
                        <ul class="inline" id="laptop">
                            <li>
                            by <strong>
                                    <a href="">
                                        Daniel Ljungqvist
                                    </a>
                                </strong> in 
                                <strong>
                                    <a href="">
                                        Tech
                                    </a>
                                </strong>
                            </li>
                        </ul>
                        <ul class="inline" id="mobile">
                            <li>
                            by <strong>
                                    <a href="">
                                        Daniel Ljungqvist
                                    </a>
                                </strong> in 
                                <strong>
                                    <a href="">
                                        Tech
                                    </a>
                                </strong>
                            </li>
                        </ul>
                    </div>
                </article>
            </main>
        </section>
    </div>
@endsection