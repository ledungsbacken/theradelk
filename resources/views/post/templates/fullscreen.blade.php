<div id="postPage_second">
    <div id="postPage" class="wrapper">
        <div id="coverImage">
            <div id="filter" style="background-color: rgba(44, 62, 80, {{ $post->opacity }});"></div>
            <header>
                <h1>{{ $post->title }}</h1>
                <p id="subheader">{{ $post->subtitle }}</p>

                <div id="author_section_created_views">
                    <div id="author">
                        <img src="{{ $post->user->picture }}" id="authorImage" />
                        <div id="authorName">
                            {{ $post->user->name }}
                        </div>
                    </div>
                    <div id="created">
                        <i class="fa fa-calendar"></i>
                        <div id="date">
                            {{ dateToHumanDiff($post->created_at) }}
                        </div>
                    </div>
                    <div id="views">
                        <i class="fa fa-eye"></i>
                        <div id="counter">
                            {{ $post->viewsCountRelation->count }}
                        </div>
                    </div>
                </div>
            </header>
            <picture>
                <source media="(max-width:600px)" srcset="{{ $post->headImage->phone }}">
                <source media="(min-width:601px) and (max-width:900px)" srcset="{{ $post->headImage->tablet }}">
                <source media="(min-width:901px)" srcset="{{ $post->headImage->desktop }}">
                <img src="{{ $post->headImage->phone }}" id="postImage">
            </picture>
        </div>
        <main id="postText_aside">
            <div id="middleContent">
                <section id="postText">
                    <div v-html="post.data.content" id="ckeditor"></div>
                </section>
                <aside>
                    <div id="ad">
                        <img src="https://cointelegraph.com/storage/uploads/view/4977ffd81bf014e27bfc08325e15b20e.png" alt="">
                    </div>
                </aside>
            </div>
        </main>
    </div>
</div>
<style>
    #postPage_second{
        margin-top: 0;
    }
    #topcolWrap{
        display:none;
    }
    .navbar-static-top{
        position: fixed;
    }
</style>