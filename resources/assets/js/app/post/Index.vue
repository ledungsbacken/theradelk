<template>
    <div>
        <normal-post :post="post" v-if="!post.data.isFullscreen"></normal-post>
        <fullscreen-post :post="post" v-if="post.data.isFullscreen"></fullscreen-post>
    </div>
</template>

<script>
import Post from '../../models/Post.js';
import NormalPost from './NormalPost.vue';
import FullscreenPost from './FullscreenPost.vue';

export default {
    props : {
        slug : {
            type : [String, Number]
        },
    },
    data() {
        return {
            post : new Post({ slug : this.slug }),
        }
    },
    mounted() {
        this.load();
    },
    methods : {
        load() {
            this.post.showBySlug({add_view : true}).then(post => {
                this.post = post;
            });
        },
    },
    components : {
        NormalPost,
        FullscreenPost,
    }
}
</script>

<style scoped>
</style>
