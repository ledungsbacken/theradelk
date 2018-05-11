<template>
    <modal v-if="show" width="80%" @close="$emit('close')">
        <div slot="header">
            <h4>Images</h4>
        </div>
        <div slot="body">
            <div class="row" v-if="show">
                <file-input @submit="upload"></file-input>
            </div>
            <div class="row">
                <div class="col-md-3" style="width:300px;" v-for="image in images">
                    <img :src="image.data.url" width="100%" />
                    <input type="text" readonly :id="'image_'+image.data.id" :value="image.data.url" style="width:80%;" />
                    <button @click="copyLink(image.data.id)" class="btn btn-success btn-sm" style="width:18%;">Copy</button>
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
import Image from '../../../models/Image.js';
import Modal from '../../Modal.vue';
import FileInput from '../FileInput.vue';
import Paging from '../../Paging.vue';
import Count from '../../Count.vue';

export default {
    props : {
        show : {
            type: Boolean,
            required: true
        },
    },
    data() {
        return {
            images : [],
            image : new Image(),
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
            Image.index({
                'page' : this.listData.current_page,
                'count' : this.listData.per_page
            }).then(response => {
                this.images = response.data;
                this.listData.total = response.last_page;
            });
        },
        upload(file) {
            return this.image.store(file).then(response => {
                this.image = new Image(response.data);
                if(this.images.length == this.listData.per_page) {
                    if(this.listData.total == 1) {
                        this.listData.total = this.listData.total + 1;
                    }
                    this.images.pop();
                }
                this.images.unshift(this.image);
            });
        },
        copyLink(id) {
            let input = document.getElementById('image_'+id);
            input.select();
            document.execCommand("Copy");
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