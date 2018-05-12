<template>
    <div>
        <div>
            <div id="menu_togglers">
                <li @click="showAdminPanel = true">
                    <i class="fa fa-pencil"></i>
                </li>
                <li  @click="showImagesModal = true">
                    <i class="fa fa-image"></i>
                </li>
                <input type="button" class="btn btn-success" @click="update()" value="Create" />
            </div>
            <head-images-modal
                v-model="headImage"
                v-if="showHeadImagesModal"
                :show="showHeadImagesModal"
                @close="showHeadImagesModal = false">
            </head-images-modal>
            <images-modal
                v-if="showImagesModal"
                :show="showImagesModal"
                @close="showImagesModal = false"></images-modal>
            <div id="admin" :show="showAdminPanel" v-if="showAdminPanel">
                <div class="wrapper">
                    <section id="admin">
                        <div id="centerAdmin">
                            <i class="fa fa-close" @click="showAdminPanel = false"></i>
                            <div class="row">
                                <slider
                                    ref="slider"
                                    v-model="post.data.opacity"
                                    :min="Number(0)"
                                    :max="Number(1)"
                                    :interval="Number(0.01)">
                                </slider>
                            </div>
                            <div v-for="subcategory in subcategories">
                                    <label>
                                        <input type="checkbox"
                                            v-model="chosenCategories"
                                            :value="subcategory" />
                                        {{ subcategory.category.data.name }}/{{ subcategory.data.name }}
                                    </label>
                                </div>
                            <button
                            class="form-control"
                            @click="showHeadImagesModal = true">Choose head image</button>
                            <lh-switch id="isFullscreenSwitch" v-model="isFullscreen">Fullscreen</lh-switch>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <div :post="post" v-if="post.data.is_fullscreen">
            <body style="background-color: #fff;">
                 <div id="postPage_second">
                    <div class="wrapper" id="postPage">
                        <div id="topcolWrap">
                            <div id="topper">
                                <nav id="categories">
                                    <ul class="inline">
                                        <li>
                                            <a href="/#/home">latest</a>
                                        </li>
                                        <li v-for="category in categories">
                                            <router-link :to="'/post/category/'+category.data.slug">{{ category.data.name }}</router-link>
                                        </li>
                                    </ul>
                                </nav>
                                <img src="logo.png" id="logo" alt="">
                                <nav id="core" class="inline">
                                    <ul>
                                        <li>about</li>
                                        <li>contact</li>
                                        <li>join us</li>
                                    </ul>
                                    <ul>
                                        <li><i class="fa fa-facebook"></i></li>
                                        <li><i class="fa fa-twitter"></i></li>
                                        <li><i class="fa fa-instagram"></i></li>
                                        <li><i class="fa fa-snapchat"></i></li>
                                    </ul>
                                </nav>
                                <i class="fa fa-bars" id="mobile"></i>
                            </div>
                        </div>
                        <div id="coverImage">
                            <div id="filter" :style="'background-color: rgba(44, 62, 80,' +post.data.opacity+');'"></div>
                            <header>
                                <textarea v-model="post.data.title" rows="3" spellcheck="false" placeholder="replace w/ title">{{ post.data.title }}</textarea>
                                <textarea v-model="post.data.subtitle" rows="1" spellcheck="false" placeholder="replace w/ title">{{ post.data.subtitle }}</textarea>
                            </header>
                            <picture>
                                <img v-if="headImage.data.desktop"
                                :src="headImage.data.desktop"
                                @click="showHeadImagesModal = true" id="postImage"/>
                            </picture>
                        </div>
                        <main id="postText-FullPage">
                            <editor id="editor1" v-model="post.data.content"></editor>
                        </main>
                    </div>
                </div>
            </body>
        </div>
        <div :post="post" v-if="!post.data.is_fullscreen">
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
                    <ul>
                        <li>
                            <a href="/">latest</a>
                        </li>
                    </ul>
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
                            <textarea v-model="post.data.title" rows="1" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' placeholder="Title">{{ post.data.title }}</textarea>
                            <textarea v-model="post.data.subtitle" rows="1" placeholder="Subtitle">{{ post.data.subtitle }}</textarea>
                            <div id="image_name_views">
                                <img :src="user.data.picture" id="authorImage" />
                                <p id="author_category">by <strong>{{ user.data.name }}</strong> about <strong>1 second ago</strong> in Tech</p>
                                <p id="views">
                                    <i class="fa fa-eye"></i>
                                    332
                                </p>
                            </div>
                        </header>
                        <picture>
                            <img  v-if="headImage.data.desktop" id="postImage" :src="headImage.data.desktop" @click="showHeadImagesModal = true ">
                        </picture>
                        <editor id="editor1" v-model="post.data.content"></editor>
                    </div>
                    <aside>
                        <div id="share">
                            <div id="buttons">
                                <p><strong>201</strong> shares</p>
                                <ul class="inline">
                                    <li>
                                        <i class="fa fa-facebook"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-twitter"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-reddit"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-linkedin"></i>
                                    </li>
                                </ul>
                            </div>
                            <div id="link">
                                <i class="fa fa-share-alt" aria-hidden="true"></i>
                                <input type="text" value="http://www.theradelk.com/dsadsa">
                            </div>
                        </div>
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
    </div>
</template>
<script>
import Post from '../../../models/Post.js';
import HeadImage from '../../../models/HeadImage.js';
import Subcategory from '../../../models/Subcategory.js';
import User from '../../../models/User.js';
import ImagesModal from '../ImagesModal.vue';
import HeadImagesModal from './HeadImagesModal.vue';
import Editor from '../Ckeditor.vue';
import Switch from '../../Switch.vue';
import Slider from 'vue-slider-component';
import Category from '../../../models/Category.js';


export default {
    props : {
        id : {
            type : [Number, String],
            required : true,
        }
    },
    data() {
        return {
            user : User.getCurrent(),
            categories : {},
            subcategories : {},
            chosenCategories : [],
            showImagesModal : false,
            showAdminPanel : false,
            showHeadImagesModal : false,
            post : new Post({ id: this.id, opacity: 0.3 }),
            headImage : new HeadImage(),
            isFullscreen : false,
        }
    },
    mounted() {
        this.load();
        this.post.show().then(post => {
            this.post = post;
            this.isFullscreen = Boolean(this.post.data.is_fullscreen);
            if(this.post.headImage) {
                this.headImage = this.post.headImage;
            }
            this.post.subcategories.forEach(subcategory => {
                this.chosenCategories.push(subcategory);
            });
        });
    },
    methods : {
        load() {
            Subcategory.index().then(response => {
                this.subcategories = response;
            }),
            Category.index().then(categories => {
                this.categories = categories;
            });
        },
        update() {
            this.post.data.head_image_id = this.headImage.data.id;
            this.post.data.subcategories = this.chosenCategories;
            this.post.update().then(post => {
                this.post = post;
            });
        },
    },
    beforeRouteLeave (to, from, next) {
        CKEDITOR.instances.editor1.destroy();
        next();
    },
    watch : {
        'isFullscreen' : function(value) {
            this.post.data.is_fullscreen = value;
        },
    },
    components : {
        ImagesModal : ImagesModal,
        HeadImagesModal : HeadImagesModal,
        Editor : Editor,
        LhSwitch : Switch,
        Slider : Slider,
    }
}
</script>

<style>
body{
    background-color: #fff;
    line-height:inherit !important;
    color:inherit !important;
    font-family: inherit !important;
    font-size:inherit !important;
}
.container{
    width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
}
#topper_padding{
}
h1,h2,h3{
    line-height: inherit !important;
}
.navbar{
    padding:0;
    margin: 0;
    overflow: hidden;
    height:39px;
    min-height:auto;
    padding:10px;
    box-sizing:border-box !important;
}
.navbar *{
    padding: 0;
    margin: 0;
}
.navbar li a{
    margin: 0;
    padding: 0;
}
#app-navbar-collapse{
    padding: 0;
    margin: 0;
    height:30px !important;
}
*{
    box-sizing:content-box !important;
}
</style>
