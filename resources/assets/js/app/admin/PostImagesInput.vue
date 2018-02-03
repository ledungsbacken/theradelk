<template>
<form enctype="multipart/form-data" id="file-form" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md-2">Thumbnail:</div>
        <input id="thumbnail"
            style="display: inline; width: 180px;"
            class="input-sm"
            name="thumbnail"
            @change="files.thumbnail = $event.target.files[0]"
            type="file"/>
    </div>
    <div class="row">
        <div class="col-md-2">Desktop:</div>
        <input id="desktop"
            style="display: inline; width: 180px;"
            class="input-sm"
            name="desktop"
            @change="files.desktop = $event.target.files[0]"
            type="file"/>
    </div>
    <div class="row">
        <div class="col-md-2">Tablet:</div>
        <input id="tablet"
            style="display: inline; width: 180px;"
            class="input-sm"
            name="tablet"
            @change="files.tablet = $event.target.files[0]"
            type="file"/>
    </div>
    <div class="row">
        <div class="col-md-2">Phone:</div>
        <input id="phone"
            style="display: inline; width: 180px;"
            class="input-sm"
            name="phone"
            @change="files.phone = $event.target.files[0]"
            type="file"/>
    </div>
    <button class="btn btn-success btn-sm" v-if="files.desktop && files.tablet && files.phone && files.thumbnail"
    <button class="btn btn-success btn-sm" v-if="files.thumbnail && files.desktop && files.tablet && files.phone"
        @click.prevent="$emit('submit', files)"
        >
        Ladda upp
    </button>
</form>
</template>

<script>
export default {
    data() {
        return {
            files : {
                thumbnail : null,
                desktop : null,
                tablet : null,
                phone : null,
            },
        }
    },
    mounted() {
        let self = this;
        var uploadForm = document.getElementById('file-form');
        var startUpload = function(files) {
            self.$emit('submit', files)
        }
        uploadForm.addEventListener('submit', function(e) {
            let files = [];
            files.push(document.getElementById('thumbnail').files);
            files.push(document.getElementById('desktop').files);
            files.push(document.getElementById('tablet').files);
            files.push(document.getElementById('phone').files);
            e.preventDefault();
            startUpload(files);
        });
    }
}
</script>

<style scoped>
/* layout.css Style */
.upload-drop-zone {
    height: 180px;
    border-width: 2px;
    margin-bottom: 20px;
}
/* skin.css Style*/
.upload-drop-zone {
    color: #a4a4a4;
    border-style: dashed;
    border-color: #ccc;
    line-height: 60px;
    text-align: center
}
.upload-drop-zone.drop {
    color: #222;
    border-color: #222;
}
</style>
