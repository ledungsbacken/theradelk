<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Posts</div>

                    <div class="panel-body">
                        <div>
                            <button @click="show = true">Bilder</button>
                            <images-modal v-if="show" :show="show" @close="show = false">
                                <h4 slot="header"></h4>
                                <div slot="body"></div>
                                <div slot="footer"></div>
                            </images-modal>
                        </div><br />
                        <input type="text" v-model="post.data.title" placeholder="Image Url" /><br /><br />
                        <input type="text" v-model="post.data.title" placeholder="Title" /><br /><br />
                        <input type="text" v-model="post.data.subtitle" placeholder="Subtitle" /><br /><br />
                        <div v-for="subcategory in subcategories">
                            <label>
                                <input
                                    type="checkbox"
                                    v-model="chosenCategories"
                                    :value="subcategory" />
                                    <!-- @click="handleCategory(subcategory.data.id)" -->
                                {{ subcategory.category.data.name }}/{{ subcategory.data.name }}
                            </label>
                        </div>
                        <editor id="editor1" v-model="post.data.content"></editor>
                        <input type="button" class="btn btn-success" @click="store()" value="Create" /><br /><br />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Post from '../../../models/Post.js';
import Subcategory from '../../../models/Subcategory.js';
import ImagesModal from './ImagesModal.vue';
import Editor from '../Ckeditor.vue';

export default {
    data() {
        return {
            content : '',
            subcategories : {},
            chosenCategories : [],
            show : false,
            post : new Post(),
        }
    },
    mounted() {
        this.load();
    },
    methods : {
        load() {
            Subcategory.index().then(response => {
                this.subcategories = response;
            });
        },
        store() {
            this.post.data.subcategories = this.chosenCategories;
            this.post.store().then(post => {
                console.log(post);
                this.post = post;
            });
        }
    },
    beforeRouteLeave (to, from, next) {
        CKEDITOR.instances.editor1.destroy();
        next();
    },
    components : {
        ImagesModal : ImagesModal,
        Editor : Editor,
    }
}
</script>

<style scoped>
</style>
