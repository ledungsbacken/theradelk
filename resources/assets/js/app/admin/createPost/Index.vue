<template>
    <div>
        <options
            :categories="post.data.subcategories"
            :opacity="post.data.opacity"
            :fullscreen="post.data.is_fullscreen"
            @opacity="post.data.opacity = $event"
            @subcategories="post.data.subcategories = $event"
            @headImage="post.data.head_image_id = $event.data.id; post.headImage = $event"
            @fullscreen="post.data.is_fullscreen = $event">
        </options>
        <normal-post
            :post="post"
            :user="user"
            @post="post = $event"
            @save="store()"
            v-if="!post.data.is_fullscreen">
        </normal-post>
        <fullscreen-post
            :post="post"
            :user="user"
            @post="post = $event"
            @save="store()"
            v-if="post.data.is_fullscreen">
        </fullscreen-post>
    </div>
</template>

<script>
import Post from '../../../models/Post.js';
import User from '../../../models/User.js';
import Options from '../Options.vue';
import NormalPost from '../NormalPostForm.vue';
import FullscreenPost from '../FullscreenPostForm.vue';

export default {
    data() {
        return {
            post : new Post({ opacity: 0.3 }),
            user : User.getCurrent(),
        }
    },
    created() {
        this.post.data.subcategories = [];
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
