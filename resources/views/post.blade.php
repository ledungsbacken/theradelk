@extends('master')
@section('content')
    @if($post->is_fullscreen)
        @include('post.fullscreen')
    @else
        @include('post.normal')
    @endif
@endsection
