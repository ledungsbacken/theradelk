<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Posts</div>

                    <div class="panel-body">
                        <div v-for="post in posts">{{ post.title }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Post from '../../models/Post.js';

export default {
    data() {
        return {
            posts : {},
        }
    },
    mounted() {
        this.load();
    },
    methods : {
        load() {
            Post.index().then(posts => {
                this.posts = posts;
            });
        },
    }
}
</script>

<style scoped>
</style>
