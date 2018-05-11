<template>
    <modal v-if="show" width="80%" @close="$emit('close')">
        <div slot="header">
            <h4>Posts</h4>
        </div>
        <div slot="body">
            <div>
                <ul class="list-group">
                    <li
                        v-for="post in posts"
                        class="list-group-item"
                        @click="select(post)">
                            {{ post.data.title }}
                    </li>
                </ul>
            </div>
        </div>
        <div slot="footer">

        </div>
    </modal>
</template>

<script>
import Post from '../../../../models/Post.js';
import Modal from '../../../Modal.vue';

export default {
    props : {
        show : {
            type: Boolean,
            required: true
        },
        category_id : {
            required: true
        },
    },
    data() {
        return {
            posts : [],
        }
    },
    mounted() {
        this.load();
    },
    methods : {
        load() {
            let args = {};
            if(this.category_id) {
                args.category_id = this.category_id;
            }
            Post.indexByCategory(args).then(posts => {
                this.posts = posts;
            });
        },
        select(post) {
            this.$emit('select', post);
        },
    },
    watch : {

    },
    components : {
        Modal,
    }
}
</script>

<style scoped>
</style>