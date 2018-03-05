<div>Title: {{ $post->title }}</div>
<div>Author: {{ $post->user->name }}</div>
<div>Views: {{ $post->viewsCountRelation->count }}</div>
<div>Posted: {{ dateToHumanDiff($post->created_at) }}</div>
<div><a href="/post/{{ $post->slug }}">Link</a></div>
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
