<template>
    <div>
        {{ parseInt(facebook.data.share.share_count) + parseInt(linkedIn.count) }}
    </div>
</template>

<script>
    export default {
        props : {
            linkedin : {
                type : [String],
                required : true,
            }
        },
        data() {
            return {
                url : window.location.href,
                facebook : {data:{share:{}}},
                twitter : {},
                linkedIn : JSON.parse(this.linkedin),
                headers : {
                    'user-agent' : 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',
                    'crossDomain': true,
                },
            }
        },
        mounted() {
            this.loadFacebookData();
            // this.loadTwitterData();
            // this.loadLinkedInData();
        },
        methods : {
            loadFacebookData() {
                axios.get('https://graph.facebook.com/?id='+this.url).then(response => {
                    this.facebook = response;
                });
            },
            loadTwitterData() {
                axios.get('http://cdn.api.twitter.com/1/urls/count.json?url='+this.url).then(response => {
                    this.twitter = response;
                });
            },
            loadLinkedInData() {
                axios.get('https://www.linkedin.com/countserv/count/share?url='+this.url+'&format=json', this.headers).then(response => {
                    this.linkedIn = response;
                }).catch(()=>{});
            },
        },
    }
</script>
