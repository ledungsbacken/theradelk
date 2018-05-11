<div id="progressBar"></div>
<div id="smallPage">
    <div id="progressMarker">
        <div id="sections">
            <div id="picture_text">
                <header>
                    <h1>{{ $post->title }}</h1>
                    <p id="subtitle">{{ $post->subtitle }}</p>
                    <div id="image_name_views">
                        <img src="{{ $post->user->picture }}" id="authorImage" />
                        <p id="author_category">by <a href="../user/{{ $post->user->id }}"><strong>{{ $post->user->name }}</strong></a> about {{ dateToHumanDiff($post->published) }} in <strong>@foreach($post->subcategories as $subcategory) <a href="/category/{{ $subcategory->category->slug }}/{{ $subcategory->slug }}">{{ $subcategory->category->name }}</a> @endforeach</strong></p>
                        <p id="views">
                            <i class="fa fa-eye"></i>
                            {{ $post->viewsCountRelation->count }}
                        </p>
                    </div>
                    <ul class="inline" id="phoneShare">
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
                            <a href="https://reddit.com/submit?url=https://theradelk.com/post/{{ $post->slug }}&title={{ $post->title }}" class="sharer">
                                <i class="fab fa-reddit"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://theradelk.com/post/{{ $post->slug }}&title={{ $post->title }}&summary={{ $post->subheader }}&source=TheRadElk" class="sharer">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                </header>
                <div id="share">
                    <div id="buttons">
                        <ul class="inline">
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
                </div>
                <picture>
                    <img src="{{ $post->headImage->desktop }}" id="postImage">
                </picture>
                <main>
                    <section id="postText">
                        {!! $post->content !!}
                    </section>
                </main>
            </div>
            <aside>
                <div id="newsletter">
                    <h2>Join the newsletter</h2>
                    <p>
                        We send out newsletters on a regular basis
                        where we include the very latest of theradelk.
                        Subscribe and stay tuned to the elk's nest!
                    </p>
                    <form action="">
                        <input type="text">
                        <button type="submit">Go!</button>
                    </form>
                </div>
                <section id="relatedPosts">
                    <h2>You might also like..</h2>
                    @foreach ($relatedPosts as $related)
                    <article>
                        <a href="{{ $related->slug }}">
                            <img src="{{ $related->headImage->thumbnail }}" alt="">
                            <h3>{{ $related->title }}</h3>
                            <p>{{ dateToHumanDiff($related->created_at) }} ago by {{ $related->user->name }}</p>
                        </a>
                    </article>
                    @endforeach
                </section>
            </aside>
        </div>
    </div>
</div>
