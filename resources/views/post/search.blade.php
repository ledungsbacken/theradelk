@extends('master')
@section('content')
<div id="startPage">
	<div id="latest">
	    <div class="wrapper">
	        <header>
	            <h1>Search results</h1>
	        </header>
	            <main id="indexPosts">
	                @each('includes.post', $posts, 'post')
	            </main>
	        </div>
	    </div>
	</div>
</div>
@endsection
