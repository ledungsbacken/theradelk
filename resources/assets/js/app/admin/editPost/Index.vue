<template>
    <div>
        <alert v-if="alert.show" :data="alert.data" @close="alert.show = false"></alert>
        <options
            :categories="post.data.subcategories"
            :opacity="post.data.opacity"
            :fullscreen="post.data.is_fullscreen"
            @opacity="post.data.opacity = $event"
            @subcategories="post.data.subcategories = $event"
            @headImage="post.data.head_image_id = $event.data.id; post.headImage = $event"
            @fullscreen="post.data.is_fullscreen = $event"
            v-if="exists">
        </options>
        <normal-post
            :post="post"
            :user="post.user"
            @post="post = $event"
            @save="update()"
            v-if="!post.data.is_fullscreen && exists">
        </normal-post>
        <fullscreen-post
            :post="post"
            :user="post.user"
            @post="post = $event"
            @save="update()"
            v-if="post.data.is_fullscreen && exists">
        </fullscreen-post>
    </div>
</template>

<script>
import Post from '../../../models/Post.js';
import User from '../../../models/User.js';
import Options from '../Options.vue';
import NormalPost from '../NormalPostForm.vue';
import FullscreenPost from '../FullscreenPostForm.vue';
import Alert from '../../Alert.vue';

export default {
    props : {
        id : {
            type : [Number, String],
            required : true,
        }
    },
    data() {
        return {
            post : new Post({ id: this.id, opacity: 0.3 }),
            exists : false,
            alert : {
                show : false,
                data : {
                    status : {
                        name : '',
                        label : '',
                    },
                    message : '',
                },
            },
        }
    },
    created() {
        this.post.data.subcategories = [];
    },
    mounted() {
        this.post.show().then(post => {
            this.post = post;
            this.post.data.subcategories = this.post.subcategories;
            this.exists = true;
        });
    },
    methods : {
        debug(data) {
            console.log(data);
        },
        update() {
            this.post.update().then(post => {
                this.post = post;
                this.post.data.subcategories = this.post.subcategories;
                this.alert.data.status.name = 'success';
                this.alert.data.status.label = 'Saved';
                this.alert.data.message = 'Post successfully updated';
                this.alert.show = true;
            });
        },
    },
    watch : {

    },
    components : {
        Options,
        NormalPost,
        FullscreenPost,
        Alert,
    }
}
</script>

<style scoped>
</style>
