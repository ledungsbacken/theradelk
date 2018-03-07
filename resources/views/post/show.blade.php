@extends('master')
<?php $title = $post->title ?>
@push('meta')

@endpush
@section('content')
    @if($post->is_fullscreen)
        @include('post.templates.fullscreen')
    @else
        @include('post.templates.normal')
    @endif
@endsection
