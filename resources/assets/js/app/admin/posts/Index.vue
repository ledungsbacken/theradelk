<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Manage Posts</div>

                    <div class="panel-body">
                        <div class="row" v-if="isModerator">
                            <div class="col-md-2">
                                <lh-switch id="showAllSwitch" v-model="showAll">Show All</lh-switch>
                            </div>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Published</th>
                                    <th></th>
                                    <th>Hidden</th>
                                    <th></th>
                                    <th>Categories</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="post in posts">
                                    <td>{{ post.data.title }}</td>
                                    <td>{{ post.user.data.name }}</td>
                                    <td>
                                        {{ published(post.data.published) }}
                                    </td>
                                    <td>
                                        <button
                                            v-if="!post.data.published"
                                            class="btn btn-sm btn-success"
                                            @click="setPublish(post)">
                                                Publish
                                        </button>
                                        <button
                                            v-if="post.data.published"
                                            class="btn btn-sm btn-warning"
                                            @click="setPublish(post)">
                                                Unpublish
                                        </button>
                                    </td>
                                    <td>
                                        {{ hidden(post.data.hidden) }}
                                    </td>
                                    <td>
                                        <button
                                            v-if="!post.data.hidden"
                                            class="btn btn-sm btn-warning"
                                            @click="setHidden(post)">
                                                Hide
                                        </button>
                                        <button
                                            v-if="post.data.hidden"
                                            class="btn btn-sm btn-success"
                                            @click="setHidden(post)">
                                                Show
                                        </button>
                                    </td>
                                    <td>
                                        <span v-for="subcategory in post.subcategories" style="display:block;">
                                            <a :href="'/post/category/' + subcategory.category.data.slug">
                                                {{subcategory.category.data.name}}
                                            </a>
                                            /
                                            <a :href="'/post/category/' + subcategory.category.data.slug + '/' + subcategory.data.slug">
                                                {{ subcategory.data.name }}
                                            </a>
                                        </span>
                                    </td>
                                    <td>
                                        <router-link :to="'/post/'+post.data.id"
                                            class="btn btn-sm btn-primary"
                                            v-if="post.data.user_id == currentUser.data.id || isAdmin">
                                            Edit
                                        </router-link>
                                        <a :href="'/post/'+post.data.slug" class="btn btn-sm btn-success">
                                            View
                                        </a>
                                        <button class="btn btn-sm btn-danger"
                                            v-if="!post.data.deleted_at"
                                            @click="destroy(post)">
                                                Delete
                                        </button>
                                        <button class="btn btn-sm btn-primary"
                                            v-if="post.data.deleted_at"
                                            @click="restoreDestroyed(post)">
                                                Restore
                                        </button>
                                        <button class="btn btn-sm btn-danger"
                                            v-if="isAdmin"
                                            @click="hardDelete(post)">
                                                <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <paging v-model="listData.current_page" class="paging" style="float:left;" :total="listData.total">
                        </paging>
                        <count :counts="counts" class="paging" style="float:right;" v-model="listData.per_page">
                        </count>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Post from '../../../models/Post.js';
import User from '../../../models/User.js';
import Paging from '../../Paging.vue';
import Count from '../../Count.vue';
import Switch from '../../Switch.vue';

export default {
    data() {
        return {
            posts : {},
            currentUser : User.getCurrent(),
            isModerator : (User.hasRole('moderator') || User.hasRole('admin') || User.hasRole('super_admin')),
            isAdmin : (User.hasRole('admin') || User.hasRole('super_admin')),
            isSuperAdmin : User.hasRole('super_admin'),
            showAll : false,
            counts : [5, 10, 30],
            listData : {
                'total': 0,
                'per_page': 5,
                'current_page': 1,
            }
        }
    },
    mounted() {
        this.load();
    },
    methods : {
        load() {
            Post.indexAdmin({
                'showAll' : this.showAll,
                'page' : this.listData.current_page,
                'count' : this.listData.per_page
            }).then(posts => {
                this.posts = posts.data;
                this.listData.total = posts.last_page;
            });
        },
        published(value) {
            if(value) {
                return 'Published';
            } else {
                return 'Unpublished';
            }
        },
        hidden(value) {
            if(value) {
                return 'Hidden';
            } else {
                return 'Not hidden';
            }
        },
        setPublish(post) {
            if(post.data.published) {
                post.data.published = 0;
            } else {
                post.data.published = 1;
            }
            post.setPublished().then(response => {
                this.load();
                this.$swal({
                    type: post.data.published ? 'success' : 'info',
                    title: post.data.published ? 'Post has been published!' : 'Post has been unpublished!',
                    showConfirmButton: true,
                    timer: 1500,
                });
            }).catch(error => {
                post.reset();
            });
        },
        setHidden(post) {
            if(post.data.hidden) {
                post.data.hidden = 0;
            } else {
                post.data.hidden = 1;
            }
            post.setHidden().then(response => {
                this.load();
            });
        },
        destroy(post) {
            post.destroy().then(response => {
                this.load();
            });
        },
        restoreDestroyed(post) {
            post.restoreDestroyed().then(response => {
                this.load();
            });
        },
        hardDelete(post) {
            if(confirm('Are you sure you want to permanently delete this post?')) {
                post.hardDelete().then(response => {
                    this.load();
                });
            }
        },
    },
    watch : {
        'showAll' : function(value){
            this.load();
        },
        'listData.current_page' : function(value){
            this.load();
        },
        'listData.per_page' : function(value){
            this.load();
        },
    },
    components : {
        paging : Paging,
        count : Count,
        LhSwitch : Switch,
    }
}
</script>

<style scoped>
</style>
