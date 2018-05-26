<template>
    <modal v-if="show" width="40%" @close="$emit('close')">
        <div slot="header">
            <h4>Credits</h4>
        </div>
        <div slot="body">
            <input v-model="headImage.data.credits" placeholder="Credits" />
        </div>
        <div slot="footer">
            <button class="btn btn-sm btn-success float-right" @click="save()">Save</button>
            <button class="btn btn-sm btn-warning float-right" @click="$emit('close')">Close</button>
        </div>
    </modal>
</template>

<script>
import Modal from '../Modal.vue';

export default {
    props : {
        show : {
            type: Boolean,
            required: true
        },
        value : {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            headImage : this.value,
        }
    },
    mounted() {

    },
    methods : {
        save() {
            this.headImage.update().then(headImage => {
                this.headImage = headImage;
                this.$emit('input', headImage);
                this.$emit('close');
            });
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
