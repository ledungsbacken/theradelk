<template>
    <div>
        <input
            type="email"
            placeholder="Email"
            id="subscriber_email"
            required
            v-model="subscriber.data.email"
            @keydown.enter="signUp()" />
        <button @click="signUp()">Sign up</button>
    </div>
</template>

<script>
import Subscriber from '../models/Subscriber.js';

export default {
    data() {
        return {
            subscriber : new Subscriber(),
        }
    },
    mounted() {

    },
    methods : {
        signUp() {
            if(document.getElementById('subscriber_email').reportValidity()) {
                this.subscriber.store().then(subscriber => {
                    this.subscriber = subscriber;
                    this.$swal({
                        type: 'success',
                        title: 'Success',
                        text: 'You are now subscribed to our newsletter',
                    });
                }).catch(error => {
                    let message = '';
                    for(let i in error.response.data) {
                        for(let j in error.response.data[i]) {
                            message += error.response.data[i][j]+'\n';
                        }
                    }
                    this.$swal({
                        type: 'error',
                        title: 'Oops...',
                        text: message,
                    });
                });
            }
        },
    },
}
</script>

<style scoped>
</style>
