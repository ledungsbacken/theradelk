@extends('master')
<?php $title = ($post->title) ?>
@push('meta')
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@theradelk" />
<meta property="og:url" content="https://www.theradelk.com/post/{{ $post->slug }}">
<meta property="og:title" content="{{ $post->title }}">
<meta property="og:description"  content="{{ $post->subtitle }}">
<meta property="og:image" content="https://theradelk.com{{ $post->headImage->thumbnail }}">

@endpush
@section('content')
    @if($post->is_fullscreen == '1')
        @include('post.templates.fullscreen')
    @else
        @include('post.templates.normal')
    @endif
@endsection

@push('script')
    <script src="{{ mix('js/scrollProgress.js') }}"></script>
@endpush
