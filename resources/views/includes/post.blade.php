<div>Title: {{ $post->title }}</div>
<div>Author: <a href="/user/{{ $post->user->id }}">{{ $post->user->name }}</a></div>
<div>Views: {{ $post->viewsCountRelation->count }}</div>
<div>Posted: {{ dateToHumanDiff($post->published) }}</div>
<div><a href="/post/{{ $post->slug }}">Link</a></div>
@foreach($post->subcategories as $subcategory)
    <div>
        Category:
        <a href="/category/{{ $subcategory->category->slug }}">
            {{ $subcategory->category->name }}
        </a>
        /
        <a href="/category/{{ $subcategory->category->slug }}/{{ $subcategory->slug }}">
            {{ $subcategory->name }}
        </a>
    </div>
@endforeach
<br />
