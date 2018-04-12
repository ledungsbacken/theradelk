<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Posts</div>

                    <div class="panel-body">
                        <div class="row">
                            <button @click="showImagesModal = true">Images</button>
                            <images-modal
                                v-if="showImagesModal"
                                :show="showImagesModal"
                                @close="showImagesModal = false"></images-modal>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <lh-switch id="isFullscreenSwitch" v-model="isFullscreen">Fullscreen</lh-switch>
                            </div>
                        </div>
                        <div class="row">
                            <slider
                                ref="slider"
                                v-model="post.data.opacity"
                                :min="Number(0)"
                                :max="Number(1)"
                                :interval="Number(0.01)">
                            </slider>
                        </div>
                        <div class="row">
                            <img v-if="headImage.data.thumbnail"
                                :src="headImage.data.thumbnail"
                                @click="showHeadImagesModal = true"
                                width="100%" />
                            <button
                                class="form-control"
                                v-if="!headImage.data.thumbnail"
                                @click="showHeadImagesModal = true">Choose head image</button>
                            <head-images-modal
                                v-model="headImage"
                                v-if="showHeadImagesModal"
                                :show="showHeadImagesModal"
                                @close="showHeadImagesModal = false">
                            </head-images-modal>

                            <input
                                type="text"
                                class="form-control"
                                v-model="post.data.title"
                                placeholder="Title" />
                            <input
                                type="text"
                                class="form-control"
                                v-model="post.data.subtitle"
                                placeholder="Subtitle" />

                            <div v-for="subcategory in subcategories">
                                <label>
                                    <input type="checkbox"
                                        v-model="chosenCategories"
                                        :value="subcategory" />
                                    {{ subcategory.category.data.name }}/{{ subcategory.data.name }}
                                </label>
                            </div>

                            <editor id="editor1" v-model="post.data.content"></editor>
                            <input type="button" class="btn btn-success" @click="store()" value="Create" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Post from '../../../models/Post.js';
import HeadImage from '../../../models/HeadImage.js';
import Subcategory from '../../../models/Subcategory.js';
import ImagesModal from '../ImagesModal.vue';
import HeadImagesModal from './HeadImagesModal.vue';
import Editor from '../Ckeditor.vue';
import Switch from '../../Switch.vue';
import Slider from 'vue-slider-component';

export default {
    data() {
        return {
            content : '',
            subcategories : {},
            chosenCategories : [],
            showImagesModal : false,
            showHeadImagesModal : false,
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
            });
        },
        store() {
            this.post.data.head_image_id = this.headImage.data.id;
            this.post.data.subcategories = this.chosenCategories;
            this.post.store().then(post => {
                this.post = post;
                this.$router.push('/post');
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
</style>
