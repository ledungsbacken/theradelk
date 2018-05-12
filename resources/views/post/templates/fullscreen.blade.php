<div id="progressBar"></div>
<div id="postPage_second">
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
            <main id="postText-FullPage">
                {!! $post->content !!}
            </main>
        </div>
    </div>
    <div id="continue">
        <ul>
            <li>
                <h2>popular right now</h2>
                @foreach ($relatedPosts as $related)
                <article class="fullscreenRelated">
                    <a href="{{ $related->slug }}">
                        <img src="{{ $related->headImage->thumbnail }}" alt="">
                        <h3>{{ $related->title }}</h3>
                        <p>by {{ $related->user->name }}</p>
                    </a>
                </article>
                @endforeach
            </li>
            <li>
                <h2>you might also like..</h2>
                @foreach ($relatedPosts as $related)
                <article class="fullscreenRelated">
                    <a href="{{ $related->slug }}">
                        <img src="{{ $related->headImage->thumbnail }}" alt="">
                        <h3>{{ $related->title }}</h3>
                        <p>by {{ $related->user->name }}</p>
                    </a>
                </article>
                @endforeach
            </li>
        </ul>
    </div>
</div>
<style>
    #topper_padding,
    #topcolWrap{
        display:none;
    }
</style>