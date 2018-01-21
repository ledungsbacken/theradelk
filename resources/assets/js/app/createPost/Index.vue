<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Posts</div>

                    <div class="panel-body">
                        <input type="text" v-model="post.data.title" placeholder="title" /><br /><br />
                        <input type="text" v-model="post.data.subtitle" placeholder="subtitle" /><br /><br />
                        <editor v-model="post.data.content"></editor>
                        <input type="button" class="btn btn-success" @click="store()" value="Create" /><br /><br />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Post from '../../models/Post.js';
import Editor from '../Ckeditor.vue';

export default {
    data() {
        return {
            content : '',
            post : new Post(),
        }
    },
    mounted() {
        // this.load();
    },
    methods : {
        store() {
            this.post.store().then(post => {
                console.log(post);
                this.post = post;
            });
        }
    },
    components : {
        Editor : Editor
    }
}
</script>

<style scoped>
</style>
