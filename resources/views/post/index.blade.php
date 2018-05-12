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
            <header>
                <h1 id="subtitle">
                    Recent
                </h1>
            </header>
            <main>
                @each('includes.post', $posts, 'post')
            </main>
        </section>
    </div>
@endsection