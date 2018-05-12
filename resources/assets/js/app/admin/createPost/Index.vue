<template>
    <div>
        <options
            @opacity="post.data.opacity = $event"
            @subcategories="post.data.subcategories = $event"
            @headImage="post.data.head_image_id = $event.data.id; post.headImage = $event"
            @fullscreen="post.data.is_fullscreen = $event">
        </options>
        <normal-post
            :post="post"
            @post="post = $event"
            @store="store()"
            v-show="!post.data.is_fullscreen">
        </normal-post>
        <!-- <fullscreen-post :post="post" v-show="post.data.is_fullscreen"></fullscreen-post> -->
    </div>
</template>

<script>
import Post from '../../../models/Post.js';
import HeadImage from '../../../models/HeadImage.js';
import Subcategory from '../../../models/Subcategory.js';
import Options from './Options.vue';
import NormalPost from './Normal.vue';
import FullscreenPost from './Fullscreen.vue';
import ImagesModal from '../ImagesModal.vue';
import HeadImagesModal from './HeadImagesModal.vue';
import Editor from '../Ckeditor.vue';
import Switch from '../../Switch.vue';
import Slider from 'vue-slider-component';

export default {
    data() {
        return {
            post : new Post(),
        }
    },
    mounted() {

    },
    methods : {
        debug(data) {
            console.log(data);
        },
        store() {
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

    },
    components : {
        Options,
        NormalPost,
        FullscreenPost,
    }
}
</script>

<style scoped>
</style>
