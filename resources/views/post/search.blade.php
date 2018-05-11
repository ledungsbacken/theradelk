@extends('master')
@section('content')
<div id="latest">
    <div class="wrapper">
        <header>
            <h1>Search results</h1>
        </header>
            <main>
                @each('includes.post', $posts, 'post')
            </main>
        </div>
    </div>
</div>
@endsection
