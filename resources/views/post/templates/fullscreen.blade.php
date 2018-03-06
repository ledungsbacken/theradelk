<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Fullscreen</div>

            <div class="panel-body">
                <img src="{{ $post->headImage->desktop }}" />
                <div>{!! $post->content !!}</div>
                <div>Title: {{ $post->title }}</div>
                <div>Author: {{ $post->user->name }}</div>
                <div>Slug: {{ $post->slug }}</div>
                <div>Views: {{ $post->viewsCountRelation->count }}</div>
                <div>Posted: {{ dateToHumanDiff($post->created_at) }}</div>
                @foreach($post->subcategories as $subcategory)
                    <div>
                        Category:
                        <a href="/post/category/{{ $subcategory->category->slug }}">
                            {{ $subcategory->category->name }}
                        </a>
                        /
                        <a href="/post/category/{{ $subcategory->category->slug }}/{{ $subcategory->slug }}">
                            {{ $subcategory->name }}
                        </a>
                    </div>
                @endforeach
                <br />
            </div>
        </div>
    </div>
</div>
