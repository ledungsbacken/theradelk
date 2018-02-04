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
                            <input type="button" class="btn btn-success" @click="update()" value="Save" />
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
import ImagesModal from './ImagesModal.vue';
import HeadImagesModal from './HeadImagesModal.vue';
import Editor from '../Ckeditor.vue';

export default {
    props : {
        id : {
            type : [Number, String],
            required : true,
        }
    },
    data() {
        return {
            subcategories : {},
            chosenCategories : [],
            showImagesModal : false,
            showHeadImagesModal : false,
            post : new Post({ id: this.id }),
            headImage : new HeadImage(),
        }
    },
    mounted() {
        this.load();
        this.post.show().then(post => {
            this.post = post;
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
    components : {
        ImagesModal : ImagesModal,
        HeadImagesModal : HeadImagesModal,
        Editor : Editor,
    }
}
</script>

<style scoped>
</style>
