<template>
    <div>
        <post-loader v-for="p in page" :key="p.id" :page="p" @done="isOver = false"></post-loader>
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
