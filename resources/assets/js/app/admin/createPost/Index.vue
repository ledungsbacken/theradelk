<template>
    <div>
        <options
            :categories="post.data.subcategories"
            :opacity="post.data.opacity"
            :fullscreen="post.data.is_fullscreen"
            @opacity="post.data.opacity = $event"
            @subcategories="post.data.subcategories = $event"
            @headImage="post.data.head_image_id = $event.data.id; post.headImage = $event"
            @fullscreen="post.data.is_fullscreen = $event"
            @save="store()">
        </options>
        <normal-post
            :post="post"
            :user="user"
            @post="post = $event"
            v-if="!post.data.is_fullscreen">
        </normal-post>
        <fullscreen-post
            :post="post"
            :user="user"
            @post="post = $event"
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
