<template>
    <div>
        <alert v-if="alert.show" :data="alert.data" @close="alert.show = false"></alert>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Manage user</div>

                    <div class="panel-body">
                        <div class="form-group row">
                            <label for="picture" class="col-md-1 col-md-offset-2 col-form-label" style="top:4px;">
                                Picture:
                            </label>
                            <div class="col-md-6">
                                <input type="text" id="picture" v-model="user.data.picture" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-1 col-md-offset-2 col-form-label" style="top:4px;">
                                Name:
                            </label>
                            <div class="col-md-6">
                                <input type="text" id="name" v-model="user.data.name" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-1 col-md-offset-2 col-form-label" style="top:4px;">
                                Email:
                            </label>
                            <div class="col-md-6">
                                <input type="text" id="email" v-model="user.data.email" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="editor1" class="col-md-1 col-md-offset-2 col-form-label" style="top:4px;">
                                About:
                            </label>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8 col-md-offset-2">
                                <editor id="editor1" v-model="user.data.about"></editor>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-success float-right" @click="update()">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import User from '../../../models/User.js';
import Alert from '../../Alert.vue';
import Editor from '../Ckeditor.vue';

export default {
    data() {
        return {
            user : User.getCurrent(),
            alert : {
                show : false,
                data : {
                    status : {
                        name : '',
                        label : '',
                    },
                    message : '',
                },
            },
        }
    },
    mounted() {
        this.user.show().then(user => {
            this.user = user;
        });
    },
    methods : {
        update() {
            this.user.update().then(user => {
                this.user = user;
                this.alert.data.status.name = 'success';
                this.alert.data.status.label = 'Saved';
                this.alert.data.message = 'You have successfully updated '+user.data.name;
                this.alert.show = true;
            });
        },
    },
    beforeRouteLeave (to, from, next) {
        CKEDITOR.instances.editor1.destroy();
        next();
    },
    components : {
        Alert,
        Editor : Editor,
    }
}
</script>

<style scoped>
</style>
