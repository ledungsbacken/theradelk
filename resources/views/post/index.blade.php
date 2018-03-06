@extends('master')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Posts</div>

                <div class="panel-body">
                    @each('includes.post', $posts, 'post')
                </div>
            </div>
        </div>
    </div>
@endsection
