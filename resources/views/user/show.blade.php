@extends('master')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Posts</div>

                <div class="panel-body">
                    @image(['url' => $user->picture])
                    @endimage
                    <div>Name: {{ $user->name }}</div>
                    <div>Email: {{ $user->email }}</div>
                    <div>Country: {{ $user->country }}</div>
                    <div>About: {!! $user->about !!}</div>
                    <div>Number of posts: {{ $user->posts_count }}</div>
                    <div class="panel-heading"><h4>Social links</h4></div>
                    @each('includes.country', $user->socialLinks, 'socialLink')
                    <div class="panel-heading"><h4>Posts</h4></div>
                    @each('includes.post', App\Post::indexByUser($user->id), 'post')
                </div>
            </div>
        </div>
    </div>
@endsection
