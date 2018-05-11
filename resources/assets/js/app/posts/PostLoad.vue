<template>
    <div>
        <div v-for="p in page">
            <post-loader :page="p" @done="isOver = false"></post-loader>
        </div>
    </div>
</template>

<script>
import Post from '../../models/Post.js';
import PostComponent from './Post.vue';
import PostLoader from './PostLoader.vue';

export default {
    data() {
        return {
            posts : {},
            page : 0,
            count : 4,
            skip : 12,
            scrollPercentTrigger : 80,
            isOver : false,
        }
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll);
    },
    methods : {
        load() {
            Post.index({
                'page' : this.page,
                'count' : this.count,
                'skip' : this.skip,
            }).then(posts => {
                this.posts = posts.data;
                this.page++;
                this.isOver = false;
            });
        },
        handleScroll() {
            let scroll = this.getScrollPercent();
            if(scroll >= this.scrollPercentTrigger && this.page <= 8 && !this.isOver) {
                // Load more posts
                this.isOver = true;
                this.page++;
            }
        },
        getScrollPercent() {
            let h = document.documentElement,
                b = document.body,
                st = 'scrollTop',
                sh = 'scrollHeight';
            return Math.round((h[st]||b[st]) / ((h[sh]||b[sh]) - h.clientHeight) * 100);
        },
    },
    components : {
        post : PostComponent,
        PostLoader,
    }
}
</script>

<style scoped>
</style>
