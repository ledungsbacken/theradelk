<article class="col">
        <img src="{{ $post->head_image->phone }}" alt="">
        <header>
    <a href="/post/{{ $post->slug }}" class="posts">
            <h2>{{ $post->title }}</h2>
    </a>
            <p>{{ $post->subtitle }}</p>
            <ul class="inline">
                <li>
                    by  <strong>
                            <a href="/user/{{ $post->user->id }}">
                                {{ $post->user->name }}
                            </a>
                        </strong> in 
                    @foreach($post->subcategories as $subcategory)
                        <strong>
                            <a href="/category/{{ $subcategory->category->slug }}/{{ $subcategory->slug }}">
                                {{ $subcategory->name }}
                            </a>
                        </strong>
                    @endforeach</li>
                <li>{{ dateToHumanDiff($post->created_at) }}</li>
            </ul>
        </header>
   
</article>