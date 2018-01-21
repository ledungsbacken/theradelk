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
        value : {
            type: [String, Number],
            default: ""
        },
    },
    data() {
        return {
            content: this.value,
            config: {
                toolbar: [
                    [
                        'Bold',
                        'Italic',
                        'Underline',
                        'Strike',
                        'Blockquote',
                        'NumberedList',
                        'BulletedList',
                        'Image',
                        'Source',
                        'Styles',
                        'Link',
                        'Unlink'
                    ]
                ],
                height: 300
            }
        }
    },
    mounted() {

    },
    methods : {
        update(value) {
            this.$emit('input', value);
        }
    },
    watch : {
        'content' : function(value) {
            this.update(value);
        }
    },
    components : {
        Ckeditor : Ckeditor
    }
}
</script>

<style scoped>
</style>
