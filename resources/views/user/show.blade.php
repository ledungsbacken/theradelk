@extends('master')
@section('content')
<div class="wrapper">
    <div id="author">
        <div id="authorImage">
            @image(['url' => $user->picture])
        @endimage</div>
        <h1>{{ $user->name }}</h1>
        <div id="authorInfo">
            <p>{!! $user->about !!}</p>
        </div>
        <ul id="authShortInfo" class="inline">
            <li>
                <i class="fa fa-clock-o"></i>
                <span>{{ dateToHumanDiff($user->created_at) }}</span>
            </li>
            <li>
                <i class="fa fa-file"></i>
                <span>{{ $user->posts_count }}</span>
            </li>
            <li>
                <i class="fa fa-"></i>
            </li>
        </ul>
    </div>
    <section id="latest">
        <main>
    @each('includes.post', App\Post::indexByUser($user->id), 'post')
        </main>
    </section>
</div>
@endsection
