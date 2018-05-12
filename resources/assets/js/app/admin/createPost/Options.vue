<template>
    <div>
        <button @click="showImagesModal = true">Images</button>
        <images-modal
            v-if="showImagesModal"
            :show="showImagesModal"
            @close="showImagesModal = false"></images-modal>

        <lh-switch
            id="isFullscreenSwitch"
            v-model="isFullscreen"
            @input="$emit('fullscreen', $event)">
                Fullscreen
        </lh-switch>
        <slider
            ref="slider"
            v-model="opacity"
            @input="$emit('opacity', $event)"
            :min="Number(0)"
            :max="Number(1)"
            :interval="Number(0.01)">
        </slider>

        <button
            class="form-control"
            v-if="!headImage.data.thumbnail"
            @click="showHeadImagesModal = true">Choose head image</button>
        <head-images-modal
            v-model="headImage"
            v-if="showHeadImagesModal"
            :show="showHeadImagesModal"
            @input="$emit('headImage', $event)"
            @close="showHeadImagesModal = false">
        </head-images-modal>

        <div v-for="subcategory in subcategories">
            <label>
                <input type="checkbox"
                    v-model="chosenCategories"
                    :value="subcategory" />
                {{ subcategory.category.data.name }}/{{ subcategory.data.name }}
            </label>
        </div>
    </div>
</template>

<script>
import Subcategory from '../../../models/Subcategory.js';
import HeadImage from '../../../models/HeadImage.js';
import ImagesModal from '../ImagesModal.vue';
import HeadImagesModal from './HeadImagesModal.vue';
import Switch from '../../Switch.vue';
import Slider from 'vue-slider-component';

export default {
    props : {
        // headImage : {
        //     type : Object,
        //     required : true,
        // },
    },
    data() {
        return {
            content : '',
            subcategories : {},
            chosenCategories : [],
            showImagesModal : false,
            showHeadImagesModal : false,
            headImage : new HeadImage(),
            isFullscreen : false,
            opacity : 0,
        }
    },
    mounted() {
        this.load();
        this.opacity = 0.3;
    },
    methods : {
        debug(data) {
            console.log(data);
        },
        load() {
            Subcategory.index().then(response => {
                this.subcategories = response;
            });
        },
    },
    watch : {
        'chosenCategories' : function(value) {
            this.$emit('subcategories', value);
        },
    },
    components : {
        ImagesModal : ImagesModal,
        HeadImagesModal : HeadImagesModal,
        LhSwitch : Switch,
        Slider : Slider,
    }
}
</script>

<style scoped>
</style>
