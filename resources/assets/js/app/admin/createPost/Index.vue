<template>
    <div>
        <div id="menu_togglers">
            <li @click="showAdminPanel = true">
                <i class="fa fa-pencil"></i>
            </li>
            <li  @click="showImagesModal = true">
                <i class="fa fa-image"></i>
            </li>
            <input type="button" class="btn btn-success" @click="store()" value="Create" />
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
        <normal-post :post="post" v-if="!post.data.is_fullscreen">
            <div id="smallPage">
                <div class="wrapper" id="postPage">
                    <div id="topcolWrap">
                        <div id="topper">
                            <nav id="categories">       
                                <ul class="inline">
                                    <li>
                                        <a href="#">latest</a>
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
                            <textarea v-model="post.data.title" rows="3" spellcheck="false" placeholder="replace w/ title"></textarea>
                            <textarea v-model="post.data.subtitle" rows="1" spellcheck="false" placeholder="replace w/ title"></textarea>
                        </header>
                        <picture>
                            <source media="(max-width:600px)" :srcset="headImage.data.thumbnail"  v-if="headImage.data.thumbnail">
                            <source media="(min-width:601px) and (max-width:900px)" :srcset="headImage.data.tablet"  v-if="headImage.data.tablet">
                            <source media="(min-width:901px)" :srcset="headImage.data.desktop"  v-if="headImage.data.desktop">
                            <img v-if="headImage.data.desktop" id="postImage" :src="headImage.data.thumbnail" @click="showHeadImagesModal = true" />
                        </picture>
                    </div>
                    <div id="postText_aside">
                        <div id="middleContent">
                            <section id="postText"><editor id="editor1" v-model="post.data.content"></editor></section>
                            <aside>
                                <div id="ad">
                                    <img src="https://cointelegraph.com/storage/uploads/view/4977ffd81bf014e27bfc08325e15b20e.png" alt=""></div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </normal-post>
        <fullscreen-post :post="post" v-if="post.data.is_fullscreen">
            <div id="postPage_second">
                <div class="wrapper" id="postPage">
                    <div id="topcolWrap">
                        <div id="topper">
                            <nav id="categories">
                                <ul class="inline">
                                    <li>latest</li>
                                    <li>tech</li>
                                    <li>entertainment</li>
                                    <li>fitness</li>
                                    <li>review</li>
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
                            <textarea v-model="post.data.title" rows="3" spellcheck="false" placeholder="replace w/ title"></textarea>
                            <textarea v-model="post.data.subtitle" rows="1" spellcheck="false" placeholder="replace w/ title"></textarea>
                        </header>
                        <picture>
                            <picture>
                                <source media="(max-width:600px)" :srcset="headImage.data.thumbnail"  v-if="headImage.data.thumbnail">
                                <source media="(min-width:601px) and (max-width:900px)" :srcset="headImage.data.tablet"  v-if="headImage.data.tablet">
                                <source media="(min-width:901px)" :srcset="headImage.data.desktop"  v-if="headImage.data.desktop">
                                <img v-if="headImage.data.desktop" id="postImage" :src="headImage.data.thumbnail" @click="showHeadImagesModal = true" />
                            </picture>
                        </picture>
                    </div>
                </div>
                <main id="postText-FullPage">
                    <editor id="editor1" v-model="post.data.content"></editor>
                </main>
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
    data() {
        return {
            categories : {},
            content : '',
            subcategories : {},
            chosenCategories : [],
            showImagesModal : false,
            showHeadImagesModal : false,
            showAdminPanel : false,
            post : new Post(),
            headImage : new HeadImage(),
            isFullscreen : false,
        }
    },
    mounted() {
        this.load();
        this.post.data.opacity = 0.3;
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
        store() {
            this.post.data.head_image_id = this.headImage.data.id;
            this.post.data.subcategories = this.chosenCategories;
            this.post.store().then(post => {
                this.post = post;
                this.$router.push('/admin/post');
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
    },

}

</script>

<style scoped>
.container{
    width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
}
#postPage_second{
    margin-top: -22px;
}
</style>
