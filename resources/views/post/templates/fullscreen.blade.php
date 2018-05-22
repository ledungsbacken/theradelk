<div id="progressBar"></div>


<div id="postPage_second">
    <ul class="inline" id="phoneShare">
        <li>
            <a 
                href="https://www.facebook.com/sharer/sharer.php?u=https://theradelk.com/post/{{ $post->slug }}" 
                id="fb" 
                class="sharer">
                <i class="fab fa-facebook"></i>
            </a>
        </li>
        <li>
            <a 
                href="http://twitter.com/share?text={{ $post->title }}&url=https://theradelk.com/post/{{ $post->slug }}" 
                id="twitter" 
                class="sharer">
                <i class="fab fa-twitter"></i>
            </a>
        </li>
        <li>
            <a 
                href="https://reddit.com/submit?url=https://theradelk.com/post/{{ $post->slug }}&title={{ $post->title }}" 
                id="reddit"
                class="sharer">
                <i class="fab fa-reddit"></i>
            </a>
        </li>
        <li>
            <a 
                href="https://www.linkedin.com/shareArticle?mini=true&url=https://theradelk.com/post/{{ $post->slug }}&title={{ $post->title }}&summary={{ $post->subheader }}&source=TheRadElk" 
                id="linkedin" 
                class="sharer">
                <i class="fab fa-linkedin"></i>
            </a>
        </li>
    </ul>
    <h1 id="largePageHeader">
        <a href="https://theradelk.com">theRadElk</a>
    </h1>
    <div id="postPage" class="wrapper">
        <div id="coverImage">
            <div id="filter" style="background-color: rgba(44, 62, 80, {{ $post->opacity }});"></div>
            <header>
                <h1>{{ $post->title }}</h1>
                <p id="subheader">{{ $post->subtitle }}</p>
                <div id="image_name_views">
                    <div id="authorImage_name">
                        <img src="{{ $post->user->picture }}" id="authorImage" />
                        <p id="author_category">by <a href="../user/{{ $post->user->id }}"><strong>{{ $post->user->name }}</strong></a> about {{ dateToHumanDiff($post->published) }} in <strong>@foreach($post->subcategories as $subcategory) <a href="/category/{{ $subcategory->category->slug }}">{{ $subcategory->category->name }}</a> @endforeach</strong></p>
                    </div>
                    <p id="views">
                        <i class="fa fa-eye"></i>
                        {{ $post->viewsCountRelation->count }}
                    </p>
                </div>
            </header>
            <picture>
                <source media="(max-width:600px)" srcset="{{ $post->headImage->phone }}">
                <source media="(min-width:601px) and (max-width:900px)" srcset="{{ $post->headImage->tablet }}">
                <source media="(min-width:901px)" srcset="{{ $post->headImage->desktop }}">
                <img src="{{ $post->headImage->phone }}" id="postImage">
            </picture>
        </div>
        <div id="progressMarker">
            <div id="largepage_share_scroll">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fas fa-chevron-up"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://theradelk.com/post/{{ $post->slug }}" class="sharer">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="http://twitter.com/share?text={{ $post->title }}&url=https://theradelk.com/post/{{ $post->slug }}" class="sharer">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://reddit.com/submit?url=https://theradelk.com/post/{{ $post->slug }}&title={{ $post->title }}" target="_blank">
                            <i class="fab fa-reddit"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://theradelk.com/post/{{ $post->slug }}&title={{ $post->title }}&summary={{ $post->subheader }}&source=TheRadElk" class="sharer">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <main id="postText-FullPage" class="inputs">
                {!! $post->content !!}
            </main>
        </div>
    </div>
    <div id="continue">
        <h2>popular right now</h2>
        @foreach ($popularPosts as $popular)
        <article class="fullscreenRelated">
            <a href="{{ $popular->slug }}">
                <img src="{{ $popular->headImage->thumbnail }}" alt="">
                <h3>{{ $popular->title }}</h3>
                <p>by {{ $popular->user->name }}</p>
            </a>
        </article>
        @endforeach
    </div>
    <div id="comment">
        <div id="disqus_thread"></div>
        <script>
        /**
        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
        /*
        var disqus_config = function () {
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        */
        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://theradelk-com.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    </div>
</div>
<style>
    #topper_padding,
    #topcolWrap{
        display:none;
    }
</style>
