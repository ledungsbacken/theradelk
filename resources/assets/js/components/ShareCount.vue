<template>
    <div>
        {{ parseInt(facebook.data.share.share_count) }}
    </div>
</template>

<script>
    export default {
        data() {
            return {
                url : window.location.href,
                facebook : {data:{share:{}}},
            }
        },
        mounted() {
            this.loadFacebookData();
        },
        methods : {
            loadFacebookData() {
                axios.get('https://graph.facebook.com/?id='+this.url).then(response => {
                    this.facebook = response;
                });
            }
        },
    }
</script>