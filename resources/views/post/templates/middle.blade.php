<div id="progressBar"></div>
<div id="middlePage">
	<div id="coverImage">
        <div id="filter" style="background-color: rgba(44, 62, 80, {{ $post->opacity }});"></div>
        <header>
            <h1>{{ $post->title }}</h1>
            <p id="subheader">{{ $post->subtitle }}</p>
        </header>
        <picture>
            <source media="(max-width:600px)" srcset="{{ $post->headImage->phone }}">
            <source media="(min-width:601px) and (max-width:900px)" srcset="{{ $post->headImage->tablet }}">
            <source media="(min-width:901px)" srcset="{{ $post->headImage->desktop }}">
            <img src="{{ $post->headImage->phone }}">
        </picture>
    </div>
    <div id="posttext">
    	<div id="author_share">
    		<div id="author">
	    		<img src="{{ $post->user->picture }}" id="authorImage" />
	    		<p>by
		    		<a href="../user/{{ $post->user->id }}"><strong>{{ $post->user->name }}</strong></a>
		    		about
		    		<strong>{{ dateToHumanDiff($post->published) }}</strong>
		    		in
		    		@foreach($post->subcategories as $subcategory) <a href="../category/{{ $subcategory->slug }}">{{ $subcategory->name }}</a> @endforeach
		    	</p>
		    </div>
	    	<ul id="share" class="inline">
	    		<li><i class="fab fa-twitter"></i></li>
	    		<li><i class="fab fa-facebook"></i></li>
	    		<li><i class="fab fa-linkedin"></i></li>
	    		<li><i class="fab fa-reddit"></i></li>
	    	</ul>
    	</div>
    	<p>
    		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab animi dolore consequuntur ut incidunt laboriosam bcountryitiis doloribus excepturi nostrum repudiandae magnam nobis quod reprehenderit eum dolorum, doloremque, sunt autem sint.
    	</p>
    	<p>
    		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde harum maiores tempora quos provident minima rerum repellendus, quia reprehenderit modi mollitia nisi aliquid commodi veniam nulla iusto vitae voluptatibus, vero officia, incidunt dolorum assumenda cupiditate fugit quae! Harum eum, magnam.
    	</p>
    </div>
</div>
<div id="endContent">
    <div class="wrapper">
        <ul id="endShare" class="inline">
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
</div>