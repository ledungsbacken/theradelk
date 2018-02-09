<template>
    <modal v-if="show" width="30%" @close="$emit('close')">
        <div slot="header">
            <h4>Reset {{ user.data.name }} password</h4>
        </div>
        <div slot="body">

                <div class="form-group row">
                    <label for="password" class="col-md-3 col-md-offset-1 col-form-label" style="top:4px;">
                        New password:
                    </label>
                    <div class="col-md-6">
                        <input type="password" id="password" v-model="newPassword" class="form-control" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="passwordConfirm" class="col-md-4 col-form-label" style="top:4px;">
                        Confirm new password:
                    </label>
                    <div class="col-md-6">
                        <input type="password" id="passwordConfirm" v-model="newPasswordConfirm" class="form-control" />
                    </div>
                </div>
        </div>
        <div slot="footer">
            <div class="float-right">
                <button class="btn btn-sm btn-warning" @click="$emit('close')">Close</button>
                <button class="btn btn-sm btn-success" @click="save">Save</button>
            </div>
        </div>
    </modal>
</template>

<script>
import Modal from '../../Modal.vue';

export default {
    props : {
        value : {
            type: [Object],
            required: true
        },
        show : {
            type: Boolean,
            required: true
        },
    },
    data() {
        return {
            user : this.value,
            newPassword : '',
            newPasswordConfirm : '',
        }
    },
    mounted() {
        
    },
    methods : {
        save() {
            if(this.newPassword == this.newPasswordConfirm) {
                this.user.resetPassword({
                    'newPassword' : this.newPassword,
                    'newPasswordConfirm' : this.newPasswordConfirm,
                }).then(response => {
                    this.$emit('close');
                });
            } else {
                alert('Passwords doesnt match');
            }
        },
    },
    components : {
        Modal : Modal,
    }
}
</script>

<style scoped>
</style>
