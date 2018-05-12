<template>
    <main>
        <post v-for="post in posts" :key="post.data.id" :post="post"></post>
    </main>
</template>

<script>
import Post from '../../models/Post.js';
import PostComponent from './Post.vue';

export default {
    props : {
        page : {
            type : Number,
            required : true,
        },
    },
    data() {
        return {
            posts : {},
            count : 3,
        }
    },
    mounted() {console.log('eqw');
        this.load();
    },
    methods : {
        load() {
            Post.index({
                'page' : this.page,
                'count' : this.count,
                'sortBy' : 'published',
                'sortOrder' : 'DESC',
            }).then(posts => {
                this.posts = posts.data;
                this.$emit('done');
            });
        },
    },
    components : {
        post : PostComponent,
    }
}
</script>

<style scoped>
</style>
