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
        <normal-post :post="post" v-if="post.data.is_fullscreen">
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
        </normal-post>
        <fullscreen-post :post="post" v-if="!post.data.is_fullscreen">
            <div id="smallPage">
                <div id="scrollTopper">
                    <h2>theRadElk</h2>
                    <ul id="share" class="inline"></ul>
                    <ul id="categories" class="inline">
                        <li>latest</li>
                        <li>tech</li>
                        <li>entertainment</li>
                        <li>fitness</li>
                        <li>review</li>
                    </ul>
                </div>
                <div class="wrapper">
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
                            <img src="logo-realSize.png" id="logo" alt="">
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
                            @click="showHeadImagesModal = true" id="postImage" 
                            />
                        </picture>
                    </div>
                    <main id="postText_aside">
                        <div id="middleContent">
                            <section id="postText">
                                <editor id="editor1" v-model="post.data.content"></editor>
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
        </fullscreen-post>
    </div>
</template>
<script>
import Post from '../../../models/Post.js';
import HeadImage from '../../../models/HeadImage.js';
import Subcategory from '../../../models/Subcategory.js';
import ImagesModal from './ImagesModal.vue';
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

<style scoped>
.navbar-default{
    border-color:transparent !important;
}
.navbar-static-top a{
    color:#000 !important;
}
.container{
    width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
}
</style>
