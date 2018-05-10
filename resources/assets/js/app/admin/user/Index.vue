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
                            <div class="col-md-6 col-md-offset-4">
                                <button
                                    class="btn btn-sm btn-primary"
                                    @click="showSocialLinksModal = true">
                                        Manage social links
                                </button>
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
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                                <div v-for="role in availableRoles" class="row">
                                    <span class="col-md-8">{{ role.data.label }}</span>
                                    <i class="fa fa-arrow-right btn btn-sm btn-success col-md-2 col-md-offset-1"
                                    @click="addRole(role)"></i>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <i class="fa fa-arrow-left"></i>
                                <i class="fa fa-arrow-right"></i>
                            </div>
                            <div class="col-md-4">
                                <div v-for="role in chosenRoles" class="row">
                                    <i class="fa fa-arrow-left btn btn-sm btn-success col-md-2 col-md-offset-1"
                                    @click="removeRole(role)"></i>
                                    <span class="col-md-8">{{ role.data.label }}</span>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-success float-right" @click="update()">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <social-links-modal v-if="showSocialLinksModal"
                :show="showSocialLinksModal"
                :user="user"
                @close="showSocialLinksModal = false">
        </social-links-modal>
    </div>
</template>

<script>
import User from '../../../models/User.js';
import Role from '../../../models/Role.js';
import SocialLinksModal from '../SocialLinksModal.vue';
import Alert from '../../Alert.vue';
import Editor from '../Ckeditor.vue';

export default {
    props : {
        id : {
            type : [Number, String],
            required : true,
        }
    },
    data() {
        return {
            user : new User({ id: this.id }),
            roles : [],
            chosenRoles : [],
            availableRoles : [],
            showSocialLinksModal : false,
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
            this.setChosenRoles();
            if(this.availableRoles.length > 0) {
                this.setRolesData();
            }
        });
        Role.index({ 'user_id' : this.user.data.id }).then(roles => {
            this.roles = roles;
            this.setAvailableRoles();
            if(this.chosenRoles.length > 0) {
                this.setRolesData();
            }
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
            this.user.setRoles({ 'roles' : this.chosenRoles }).then(user => {
                this.user = user;
            });
        },
        addRole(role) {
            this.chosenRoles.push(role);
            this.setRolesData();
        },
        removeRole(role) {
            this.availableRoles.push(role);
            this.chosenRoles.splice(this.chosenRoles.indexOf(role), 1);
        },
        setChosenRoles() {
            this.chosenRoles = this.user.roles;
            this.chosenRoles.forEach(role => {
                if(role.data.name == 'super_admin') {
                    const index = this.chosenRoles.indexOf(role);
                    this.chosenRoles.splice(index, 1);
                }
            });
        },
        setAvailableRoles() {
            this.availableRoles = this.roles;
        },
        setRolesData() {
            this.chosenRoles.forEach(role => {
                this.availableRoles.forEach(availableRole => {
                    if(role.data.id == availableRole.data.id) {
                        const index = this.availableRoles.indexOf(role);
                        this.availableRoles.splice(index, 1);
                    }
                });
            });
        },
    },
    beforeRouteLeave (to, from, next) {
        CKEDITOR.instances.editor1.destroy();
        next();
    },
    components : {
        SocialLinksModal,
        Alert,
        Editor : Editor,
    }
}
</script>

<style scoped>
</style>
