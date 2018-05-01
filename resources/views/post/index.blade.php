@extends('master')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Posts</div>

                <div class="panel-body">
                    @if($scenery->firstPost && $scenery->secondPost && $scenery->thirdPost)
                        <div>{{ $scenery->firstPost->id }}</div>
                        <div>{{ $scenery->secondPost->id }}</div>
                        <div>{{ $scenery->thirdPost->id }}</div>
                    @endif
                    @each('includes.post', $posts, 'post')
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
