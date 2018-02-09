<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Manage user</div>

                    <div class="panel-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-1 col-md-offset-2 col-form-label" style="top:4px;">Name:</label>
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
    </div>
</template>

<script>
import User from '../../../models/User.js';
import Role from '../../../models/Role.js';

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
}
</script>

<style scoped>
</style>
