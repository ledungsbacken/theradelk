<template>
    <div>
        <div id="topper_padding">
            <h1>COME'N'GEEK</h1>
            <p>
                Mark Zuckerberg, the CO-founder and CEO<br>
                of the social network Facebook called their<br>
                users "dumb fucks" in 2004.
            </p>
        </div>
        <div id="topcolWrap">
            <div id="topper">
                <i class="fa fa-bars" id="mobile"></i>
                <nav id="categories">
                <ul class="inline">
                    <li>
                        <a href="/">latest</a>
                    </li>
                    <li>IT</li>
                    <li>SCI-FI</li>
                    <li>ENTERTAINMENT</li>
                    <li>TECH</li>
                </ul>
                </nav>
                <a href="https://theradelk.com">
                    <img src="https://theradelk.com/logo-realSize.png" id="logo" alt="">
                </a>
                <nav id="core" class="inline">
                    <ul>
                        <li>about</li>
                        <li>contact</li>
                        <li>join us</li>
                    </ul>
                    <ul id="switch">
                    </ul>
                    <ul id="social">
                    <li><a href="https://www.facebook.com/theradelk/"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/theradelk"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://www.instagram.com/theradelk"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="https://www.snapchat.com/theradelk"><i class="fa fa-snapchat"></i></a></li>
                    <li><a href="https://www.snapchat.com/theradelk"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </nav>
            </div>
            <nav id="mobile_nav">
                <ul id="switch">
                </ul>
                <ul>
                    <li>about</li>
                    <li>contact</li>
                    <li>join us</li>
                </ul>
                <ul>
                    <li><a href="https://www.facebook.com/theradelk/"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/theradelk"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://www.instagram.com/theradelk"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="https://www.snapchat.com/theradelk"><i class="fa fa-snapchat"></i></a></li>
                    <li><a href="https://www.snapchat.com/theradelk"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </nav>
        </div>
        <div id="smallPage">
            <div id="sections">
                <div id="picture_text">
                    <header>
                        <textarea type="text"
                                v-model="mutablePost.data.title"
                                placeholder="Title" rows="1" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' ></textarea>
                        <textarea type="text"
                                v-model="mutablePost.data.subtitle"
                                placeholder="Subtitle" rows="1"></textarea>
                        <div id="image_name_views">
                            <img :src="user.data.picture" id="authorImage" />
                            <p id="author_category">by <strong>{{ user.data.name }}</strong> about <strong>1 second ago</strong> in Tech</p>
                            <p id="views">
                                <i class="fa fa-eye"></i>
                                332
                            </p>
                        </div>
                    </header>
                    <div id="share">
                        <div id="buttons">
                            <ul class="inline">
                                <li>
                                    <a href=""><i class="fas fa-chevron-up"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fab fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fab fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fab fa-reddit"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fab fa-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <picture>
                        <img v-if="mutablePost.headImage.data.desktop"
                                :src="mutablePost.headImage.data.desktop"
                                @click="showHeadImagesModal = true">
                    </picture>
                    <editor id="editor1" v-model="mutablePost.data.content"></editor>
                </div>
                <aside>
                    <div id="newsletter">
                        <h2>Don't miss a thing!</h2>
                        <p>
                            We send out newsletter in a regular basis
                            where we include the very latest of theradelk.
                            Subscribe and stay tuned to the elk's nest!
                        </p>
                        <form action="">
                            <input type="text">
                            <button type="submit">Go!</button>
                        </form>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</template>

<script>
import Editor from './Ckeditor.vue';

export default {
    props : {
        post : {
            type : Object,
            required : true,
        },
        user : {
            type : Object,
            required : true,
        },
    },
    data() {
        return {
            mutablePost : this.post,
        }
    },
    mounted() {

    },
    methods : {
        
    },
    watch : {
        'post' : function(value) {
            this.mutablePost = this.post;
        },
    },
    components : {
        Editor : Editor,
    }
}
</script>

<style scoped>
</style>
