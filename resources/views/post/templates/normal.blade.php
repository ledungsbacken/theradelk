<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Normal</div>

            <div class="panel-body">
                @image(['url' => $post->headImage->desktop])
                @endimage

                <share-count></share-count>
                <div>{!! $post->content !!}</div>
                <div>Id: {{ $post->id }}</div>
                <div>Title: {{ $post->title }}</div>
                <div>Author: {{ $post->user->name }}</div>
                <div>Slug: {{ $post->slug }}</div>
                <div>Views: {{ $post->viewsCountRelation->count }}</div>
                <div>Posted: {{ dateToHumanDiff($post->published) }}</div>
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
                <div>
                    <div>Related:</div>
                    @foreach ($relatedPosts as $related)
                    <div>
                        {{ $related->id }}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
