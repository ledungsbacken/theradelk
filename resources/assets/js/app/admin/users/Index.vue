<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>

                    <div class="panel-body">
                        <div class="row">
                                <button class="btn btn-sm btn-success col-md-2 col-md-offset-1">New user</button>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users">
                                    <td>{{ user.data.name }}</td>
                                    <td>{{ user.data.email }}</td>
                                    <td>
                                        <span v-for="role in user.roles">
                                            {{ role.data.label }}
                                        </span>
                                        <span v-if="user.roles.length == 0">None</span>
                                    </td>
                                    <td>
                                        <router-link :to="'/admin/user/' + user.data.id">
                                                <button class="btn btn-sm btn-warning">
                                                    Edit
                                                </button>
                                        </router-link>

                                        <button class="btn btn-sm btn-warning" @click="showModal(user)">
                                            Reset password
                                        </button>
                                        <button class="btn btn-sm btn-danger" @click="stripRoles(user)">
                                            Strip roles
                                        </button>
                                        <router-link :to="'/user/' + user.data.id">
                                            <button class="btn btn-sm btn-success">
                                                <i class="fa fa-arrow-right"></i>
                                            </button>
                                        </router-link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <reset-password-modal
                            v-model="chosenUser"
                            v-if="show"
                            :show="show"
                            @close="show = false">
                        </reset-password-modal>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import User from '../../../models/User.js';
import ResetPasswordModal from './ResetPasswordModal.vue';

export default {
    data() {
        return {
            users : {},
            show : false,
            chosenUser : new User(),
        }
    },
    mounted() {
        this.load();
    },
    methods : {
        load() {
            User.index().then(users => {
                this.users = users;
            });
        },
        stripRoles(user) {
            if(confirm('Are you sure you want to remove all roles from '+user.data.name+'? If you remove your own roles you wont be able to do anything anymore.')) {
                user.setRoles({ 'roles' : {} }).then(response => {
                    this.load();
                });
            }
        },
        showModal(user) {
            this.chosenUser = user;
            this.show = true;
        },
    },
    components : {
        ResetPasswordModal : ResetPasswordModal,
    }
}
</script>

<style scoped>
</style>
