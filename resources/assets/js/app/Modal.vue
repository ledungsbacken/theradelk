<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="panel panel-primary modal-container" @click="$emit('click')" :style="{ width:width }">
                    <div class="panel-heading">
                        <slot name="header">
                        </slot>
                        <i class="fa fa-window-close fa-2x float-right" style="margin-top:-34px;" @click="$emit('close')"></i>
                    </div>
                    <div class="panel-body" v-if="$slots['body']">
                        <slot name="body">
                        </slot>
                    </div>
                    <div class="row" v-if="$slots['footer']">
                        <div class="col-md-12">
                            <slot name="footer" >
                            </slot>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props : {
        width : {
            type : String,
            default : '300px'
        },
    }
}
</script>

<style scoped>
    .fa-2x{
        font-size: 20px;
    }

    .fa:hover{
        cursor: pointer;
    }

    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        margin: 0px auto;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-body {
        margin: 20px 0;
    }

    .modal-default-button {
        float: right;
    }

    .panel-body{
        max-height: calc(100vh - 212px);
        overflow-y: auto;
    }

    .row{
        margin-left: 0px;
        margin-right: 0px;
        background-color: #dde6ea;
        border-top: 1px solid #879fab;
        padding: 10px 0px;
    }




    /*
     * The following styles are auto-applied to elements with
     * transition="modal" when their visibility is toggled
     * by Vue.js.
     *
     * You can easily play with the modal transition by editing
     * these styles.
     */

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>
