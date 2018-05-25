<template>
    <div>
        <div>
            Want a cookie? HA! You cant handle my cookies!
        </div>
        <button @click="set">Accept</button>
    </div>
</template>

<script>
    export default {
        props : {

        },
        data() {
            return {

            }
        },
        mounted() {

        },
        methods : {
            set() {
                let date = new Date();
                date.setTime(date.getTime() + (364*24*60*60*1000));
                window.document.cookie = 'cookie=1; expires=' + date + '; path=/';
                window.document.getElementById('cookie').remove();
            },
        },
    }
</script>

<style scoped>
</style>
