<template>
<form enctype="multipart/form-data" id="file-form" style="margin-top: 20px;">
    <h4>Ladda upp ny fil <i class="fa fa-upload" style="color: #2ab27b;"></i></h4>
    <div class="upload-drop-zone" id="drop-zone">
        <div>Dra-och-släpp filen här</div>
        <div> - Eller - </div>
            <div>
                <input id="file-select"
                    style="display: inline; width: 180px;"
                    class="input-sm"
                    :name="name"
                    @change="file = $event.target.files[0]"
                    type="file"/>
                <button class="btn btn-success btn-sm" v-if="file"
                    @click.prevent="$emit('submit', file)"
                    >
                    Ladda upp
                </button>
            </div>
    </div>
</form>
</template>

<script>
export default {
    data() {
        return {
            name : 'file',
            file : null
        }
    },
    mounted() {
        let self = this;
        var dropZone = document.getElementById('drop-zone');
        var uploadForm = document.getElementById('file-form');
        var startUpload = function(files) {
            self.$emit('submit', files[0])
        }
        uploadForm.addEventListener('submit', function(e) {
            var uploadFiles = document.getElementById('file-select').files;
            e.preventDefault()
            startUpload(uploadFiles)
        })
        dropZone.ondrop = function(e) {
            e.preventDefault();
            this.className = 'upload-drop-zone';
            startUpload(e.dataTransfer.files)
        }
        dropZone.ondragover = function() {
            this.className = 'upload-drop-zone drop';
            return false;
        }
        dropZone.ondragleave = function() {
            this.className = 'upload-drop-zone';
            return false;
        }
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
