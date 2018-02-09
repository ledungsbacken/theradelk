<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Post</div>

                    <div class="panel-body">
                        <img v-if="post.headImage" :src="post.headImage.data.desktop" />
                        <div v-html="post.data.content"></div>
                        <div>Title: {{ post.data.title }}</div>
                        <div>Author: {{ post.user.data.name }}</div>
                        <div>Slug: {{ post.data.slug }}</div>
                        <div>Views: {{ post.data.views }}</div>
                        <div v-if="post.image"><img :src="post.image.url" /></div>
                        <div v-for="subcategory in post.subcategories">Category: {{subcategory.category.data.name}}/{{ subcategory.data.name }}</div>
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Post from '../../models/Post.js';

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
    }
}
</script>

<style scoped>
</style>
