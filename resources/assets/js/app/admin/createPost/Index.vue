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
            :user="user"
            @post="post = $event"
            @store="store()"
            v-if="!post.data.is_fullscreen">
        </normal-post>
        <fullscreen-post
            :post="post"
            :user="user"
            @post="post = $event"
            @store="store()"
            v-if="post.data.is_fullscreen">
        </fullscreen-post>
    </div>
</template>

<script>
import Post from '../../../models/Post.js';
import User from '../../../models/User.js';
import Options from './Options.vue';
import NormalPost from './Normal.vue';
import FullscreenPost from './Fullscreen.vue';

export default {
    data() {
        return {
            post : new Post(),
            user : User.getCurrent(),
        }
    },
    mounted() {
        this.post.data.subcategories = [];
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
