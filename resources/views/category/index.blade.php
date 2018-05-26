@extends('master')
@section('content')
    <div id="startPage">
        @include('includes.scenery', $scenery)
        <section id="latest">
            <main id="indexPosts">
                @each('includes.post', $posts, 'post')
            </main>
            {{ $posts->links() }}
        </section>
    </div>
@endsection
