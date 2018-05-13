<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create fullscreen post</div>

                    <div class="panel-body">
                        <div class="row">
                            <img v-if="mutablePost.headImage.data.thumbnail"
                                :src="mutablePost.headImage.data.thumbnail"
                                @click="showHeadImagesModal = true"
                                width="100%" />
                            <input
                                type="text"
                                class="form-control"
                                v-model="mutablePost.data.title"
                                placeholder="Title" />
                            <input
                                type="text"
                                class="form-control"
                                v-model="mutablePost.data.subtitle"
                                placeholder="Subtitle" />

                            <div>Author: {{ user.data.name }}</div>

                            <editor id="editor2" v-model="mutablePost.data.content"></editor>
                            <input type="button" class="btn btn-success" @click="store()" value="Create" />
                        </div>
                    </div>
                </div>
            </div>
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
        store() {
            this.$emit('store');
        },
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
