<template>
    <modal v-if="show" width="80%" @close="$emit('close')">
        <div slot="header">
            <h4>Head Images</h4>
        </div>
        <div slot="body">
            <div class="row">
                <div class="col-md-3" style="width:300px;" v-for="image in images">
                    <img :src="image.data.thumbnail" @click="select(image)" width="100%" />
                </div>
            </div>
        </div>
        <div slot="footer">
            <paging v-model="listData.current_page" class="paging" style="float:left;" :total="listData.total"></paging>
            <count :counts="counts" class="paging" style="float:right;" v-model="listData.per_page"></count>
        </div>
    </modal>
</template>

<script>
import HeadImage from '../../models/HeadImage.js';
import Modal from '../Modal.vue';
import FileInput from './FileInput.vue';
import Paging from '../Paging.vue';
import Count from '../Count.vue';

export default {
    props : {
        value : {
            type: [Object],
            required: true
        },
        show : {
            type: Boolean,
            required: true
        },
    },
    data() {
        return {
            images : [],
            chosenImage : new HeadImage(),
            counts : [5, 10, 30],
            listData : {
                'total': 0,
                'per_page': 5,
                'current_page': 1,
            }
        }
    },
    mounted() {
        this.load();
    },
    methods : {
        load() {
            HeadImage.index({
                'page' : this.listData.current_page,
                'count' : this.listData.per_page
            }).then(response => {
                this.images = response.data;
                this.listData.total = response.last_page;
            });
        },
        select(image) {
            this.chosenImage = image;
            this.$emit('input', image);
            this.$emit('close');
        },
    },
    watch : {
        'listData.current_page' : function(value){
            this.load();
        },
        'listData.per_page' : function(value){
            this.load();
        },
    },
    components : {
        Modal : Modal,
        FileInput : FileInput,
        paging : Paging,
        count : Count,
    }
}
</script>

<style scoped>
</style>
