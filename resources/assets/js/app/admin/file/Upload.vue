<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Posts</div>

                    <div class="panel-body">
                        <button @click="show = true">Open</button>
                        <modal v-if="show" @close="show = false">
                            <h4 slot="header"></h4>
                            <div slot="body"></div>
                            <div slot="footer"></div>
                        </modal>
                        <img v-if="image.data.url" :src="image.data.url" width="100%" />
                        <file-input @submit="upload"></file-input>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Image from '../../../models/Image.js';
import Modal from '../../Modal.vue';
import FileInput from '../FileInput.vue';

export default {
    data() {
        return {
            image : new Image(),
            show : false,
        }
    },
    methods : {
        upload(file) {
            return this.image.store(file).then(response => {
                this.image = new Image(response.data);
                // if (response.data.message) {
                //     alert(response.data.message);
                // }else{
                //     alert('Uploaded!');
                // }
                // this.$emit('updated', file);
            });
        }
    },
    components : {
        FileInput : FileInput,
        Modal : Modal,
    }
}
</script>

<style scoped>
</style>
