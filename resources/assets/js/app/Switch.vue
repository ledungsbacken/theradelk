<template>
    <label class="list-group-item pointer" :for="id" >
        <span>
            <slot></slot>
        </span>
        <div class="fancy-switch pull-right">
            <input :id="id"  type="checkbox" :value="value" :checked="value" @click="update($event.target.checked)">
            <label :for="id" class="label-success"></label>
        </div>
    </label>
</template>

<script>
export default {
    props : {
        id : {
            type : String,
            required : true,
        },
        value : {
            type : [Boolean, String],
            required : true,
        },
    },
    mounted() {

    },
    data() {
        return {
            isChecked : this.value
        }
    },
    methods : {
        update(checked){
            this.$emit('input', checked);
        }
    },
}
</script>

<style scoped>
.custom-checkbox {
    min-height: 1rem;
    padding-left: 0;
    margin-right: 0;
    cursor: pointer;
}
.fancy-switch>input[type="checkbox"] {
    display: none;
}
.fancy-switch>label {
    cursor: pointer;
    height: 0px;
    position: relative;
    width: 40px;
}
.fancy-switch>label::before {
    background: rgb(159, 25, 25);
    box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
    border-radius: 8px;
    content: '';
    height: 16px;
    margin-top: -8px;
    position: absolute;
    opacity: 0.3;
    transition: all 0.4s ease-in-out;
    width: 40px;
}
.fancy-switch>label::after {
    background: rgb(206, 134, 134);
    border-radius: 16px;
    content: '';
    height: 24px;
    left: -4px;
    margin-top: -8px;
    position: absolute;
    top: -4px;
    transition: all 0.3s ease-in-out;
    width: 24px;
}
.fancy-switch>input[type="checkbox"]:checked+label::before {
    background: inherit;
    opacity: 0.5;
}
.fancy-switch>input[type="checkbox"]:checked+label::after {
    background: inherit;
    left: 20px;
}
</style>
