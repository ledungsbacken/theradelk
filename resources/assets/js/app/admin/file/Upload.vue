<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Posts</div>

                    <div class="panel-body">
                        <images-modal
                            v-if="show"
                            :show="show"
                            @close="show = false"></images-modal>
                        <button @click="show = true">Images</button>
                        <br />
                        <input type="text" v-model="url" /> <button @click="bind">Bind</button>
                        <croppie :url="url" :viewport="sizes.thumbnail" @cropped="cropThumbnail"></croppie>
                        <croppie :url="url" :viewport="sizes.desktop" @cropped="cropDesktop"></croppie>
                        <croppie :url="url" :viewport="sizes.tablet" @cropped="cropTablet"></croppie>
                        <croppie :url="url" :viewport="sizes.phone" @cropped="cropPhone"></croppie>
                        <!-- <file-input @submit="upload"></file-input> -->
                        <button @click="upload">Upload</button>
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
import ImagesModal from './ImagesModal.vue';
import Croppie from '../Croppie.vue';

export default {
    data() {
        return {
            image : new HeadImage(),
            thumbnail : '',
            desktop : '',
            tablet : '',
            phone : '',
            show : false,
            url : '/images/znuhcvSE2wbhMVyaLWsFGC3yq8yNfbr1Dpm4Vb67.png',
            sizes : {
                thumbnail : {
                    width: 480,
                    height: 270
                },
                desktop : {
                    width: 1920,
                    height: 1080
                },
                tablet : {
                    width: 900,
                    height: 1000
                },
                phone : {
                    width: 548,
                    height: 650
                },
            }
        }
    },
    mounted() {
        
    },
    methods : {
        upload(files = {}) {
            files = {
                thumbnail: this.thumbnail,
                desktop: this.desktop,
                tablet: this.tablet,
                phone: this.phone,
            };
            return this.image.store(files).then(response => {
                this.image = new HeadImage(response.data);
                this.$router.push('/create/post');
            });
        },
        bind() {
            for(let child in this.$children) {
                if(this.$children[child].$vnode.tag.search('croppie') != -1) {
                    this.$children[child].bind(this.url);
                }
            }
        },
        cropThumbnail(file) {
            this.thumbnail = file;
        },
        cropDesktop(file) {
            this.desktop = file;
        },
        cropTablet(file) {
            this.tablet = file;
        },
        cropPhone(file) {
            this.phone = file;
        },
    },
    components : {
        FileInput : FileInput,
        FilesModal : FilesModal,
        Croppie,
        ImagesModal,
    }
}
</script>

<style scoped>
</style>
