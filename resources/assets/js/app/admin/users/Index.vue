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

                                        <button class="btn btn-sm btn-warning">
                                            Reset password
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            Strip roles
                                        </button>
                                        <button class="btn btn-sm btn-success">
                                            <i class="fa fa-arrow-right"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import User from '../../../models/User.js';

export default {
    data() {
        return {
            users : {},
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
    },
}
</script>

<style scoped>
</style>
