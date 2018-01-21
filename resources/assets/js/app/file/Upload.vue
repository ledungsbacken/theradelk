<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Posts</div>

                    <div class="panel-body">
                        <file-input @submit="upload"></file-input>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FileInput from '../FileInput.vue';

export default {
    methods : {
        upload() {

        }
    },
    components : {
        FileInput : FileInput
    }
}
</script>

<style scoped>
</style>
