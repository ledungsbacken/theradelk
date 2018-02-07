<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Posts</div>

                    <div class="panel-body">
                        <button @click="show = true">Open</button>
                        <files-modal v-if="show" :show="show" @close="show = false">
                            <h4 slot="header"></h4>
                            <div slot="body"></div>
                            <div slot="footer"></div>
                        </files-modal>
                        <img v-if="image.data.url" :src="image.data.url" width="100%" />
                        <file-input @submit="upload"></file-input>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import HeadImage from '../../../models/HeadImage.js';
import FilesModal from './FilesModal.vue';
import FileInput from '../PostImagesInput.vue';

export default {
    data() {
        return {
            image : new HeadImage(),
            show : false,
        }
    },
    methods : {
        upload(files) {
            return this.image.store(files).then(response => {
                this.image = new HeadImage(response.data);
                this.$router.push('/admin/create/post');
            });
        }
    },
    components : {
        FileInput : FileInput,
        FilesModal : FilesModal,
    }
}
</script>

<style scoped>
</style>
