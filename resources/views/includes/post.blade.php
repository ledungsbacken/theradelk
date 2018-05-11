<article class="col">
    <div class="hoverColors">
        <a href="/post/{{ $post->slug }}" class="posts">
            <img src="{{ $post->headImage->thumbnail }}" alt="">
            <header>
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->subtitle }}</p>
            </header>
        </a>
        <ul class="inline" id="laptop">
            <li>
                by <strong>
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
            <li>{{ dateToHumanDiff($post->published) }}</li>
        </ul>
        <ul class="inline" id="mobile">
            <li>
                <strong>
                        <a href="/user/{{ $post->user->id }}">
                            {{ $post->user->name }}
                        </a>
                </strong>
            </li>
            <li>{{ dateToHumanDiff($post->published) }}</li>
        </ul>
    </div>
</article>
