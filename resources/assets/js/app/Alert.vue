<template>
    <div class="customAlert col-md-3 col-md-offset-2">
        <div :class="'alert alert-'+data.status.name">
            <strong>{{ data.status.label }}!</strong> {{ data.message }}
        </div>
    </div>
</template>

<script>
export default {
    props : {
        data : {
            type : Object,
            required : true,
        },
    },
    mounted() {
        this.startCount();
    },
    methods : {
        startCount() {
            setTimeout(() => {
                this.$emit('close');
            }, 2000);
        },
    }
}
</script>

<style scoped>
.customAlert {
    position: fixed;
    top: 0px;
    z-index: 9999;
}
</style>
