@extends('master')
@section('content')
<div id="startPage">
    <section id="latest">
        <header>
            <h1 id="subtitle">
                Recent
            </h1>
        </header>
        <main>
            @each('includes.post', $posts, 'post')
            <postload></postload>
        </main>
    </section>
</div>
@endsection
