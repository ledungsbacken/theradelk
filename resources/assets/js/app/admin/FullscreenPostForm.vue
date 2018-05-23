<template>
    <div>
        <div id="postPage_second">
            <div class="wrapper" id="postPage">
                <div id="coverImage">
                    <div id="filter" :style="'background-color: rgba(44, 62, 80,' +post.data.opacity+');'"></div>
                    <header>
                        <textarea v-model="mutablePost.data.title" rows="3" spellcheck="false" placeholder="replace w/ title"></textarea>
                        <textarea v-model="mutablePost.data.subtitle" rows="1" spellcheck="false" placeholder="replace w/ title"></textarea>
                        <div id="image_name_views">
                            <img :src="user.data.picture" id="authorImage" />
                            <p id="author_category">by <strong>{{ user.data.name }}</strong> about <strong>1 second ago</strong> in Tech</p>
                            <p id="views">
                                <i class="fa fa-eye"></i>
                                332
                            </p>
                        </div>
                    </header>
                    <picture>
                        <source media="(max-width:600px)" :srcset="mutablePost.headImage.data.phone" v-if="mutablePost.headImage.data.phone">
                        <source media="(min-width:601px) and (max-width:900px)" :srcset="mutablePost.headImage.data.tablet" v-if="mutablePost.headImage.data.tablet">
                        <source media="(min-width:901px)" :srcset="mutablePost.headImage.data.desktop" v-if="mutablePost.headImage.data.desktop">
                        <img v-if="mutablePost.headImage.data.desktop" id="postImage" :src="mutablePost.headImage.data.desktop" @click="showHeadImagesModal = true" />
                    </picture>
                </div>
            </div>
            <main id="postText-FullPage">
                <editor id="editor1" v-model="mutablePost.data.content"></editor>
            </main>
        </div>
    </div>
</template>

<script>
import Editor from './Ckeditor.vue';

export default {
    props : {
        post : {
            type : Object,
            required : true,
        },
        user : {
            type : Object,
            required : true,
        },
    },
    data() {
        return {
            mutablePost : this.post,
        }
    },
    mounted() {

    },
    methods : {
        
    },
    watch : {

    },
    components : {
        Editor : Editor,
    }
}
</script>

<style scoped>
</style>
