<template>
    <div>
        <ckeditor
            v-model="content"
            :config="config">
        </ckeditor>
    </div>
</template>

<script>
import Ckeditor from 'vue-ckeditor2';

export default {
    props : {

    },
    data() {
        return {
            content: '',
            config: {
                toolbar: [
                    [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]
                ],
                height: 300
            }
        }
    },
    mounted() {

    },
    methods : {
        
    },
    components : {
        Ckeditor : Ckeditor
    }
}
</script>

<style scoped>
</style>
