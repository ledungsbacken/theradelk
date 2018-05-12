@extends('master')
@section('content')
<div id="author_page">
    <div class="wrapper">
        <div id="image_desc">
            <div class="authorImage">@image(['url' => $user->picture])@endimage</div>
            <main>
                <h1 id="subtitle">{{ $user->name }}</h1>
                <nav>
                    <ul id="location_posts" class="inline">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            Sweden
                        </li>
                        <li>
                            <i class="far fa-edit"></i>
                            {{ $user->posts_count }} Posts
                        </li>
                    </ul>
                    <ul id="Authsocials" class="inline">
                        @each('includes.country', $user->socialLinks, 'socialLink')
                    </ul>
                </nav>
                <section id="about" class="regular">
                    <p>{!! $user->about !!}</p>
                </section>
            </main>
        </div>
    </div>
    <section id="latest">
        <div class="wrapper">
            <main id="authPage">
                @each('includes.post', App\Post::indexByUser($user->id), 'post')
            </main>
        </div>
    </section>
</div>
@endsection
