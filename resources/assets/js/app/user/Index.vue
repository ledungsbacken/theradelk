<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">User</div>

                    <div class="panel-body">
                        <div>
                            <img v-if="user.data.picture" :src="user.data.picture" />
                            <div>Name: {{ user.data.name }}</div>
                            <div>Email: {{ user.data.email }}</div>
                            <div>About: {{ user.data.about }}</div>
                            <div>Number of posts: {{ user.posts_count }}</div>
                        </div>
                        <div class="panel-heading"><h4>Posts</h4></div>
                        <div>
                            <div v-for="post in posts">
                                <div>Title: {{ post.data.title }}</div>
                                <div>Author: {{ post.user.data.name }}</div>
                                <div>Views: {{ post.data.views }}</div>
                                <div>Posted: {{ post.dateToString(post.data.created_at) }}</div>
                                <div><router-link :to="'/post/'+post.data.slug">Link</router-link></div>
                                <div v-for="subcategory in post.subcategories">
                                    Category:
                                    <router-link :to="'/post/category/' + subcategory.category.data.slug">
                                        {{subcategory.category.data.name}}
                                    </router-link>
                                    /
                                    <router-link :to="'/post/category/' + subcategory.category.data.slug + '/' + subcategory.data.slug">
                                        {{ subcategory.data.name }}
                                    </router-link>
                                </div>
                                <br />
                            </div>
                            <paging v-model="listData.current_page" class="paging" style="float:left;" :total="listData.total"></paging>
                            <count :counts="counts" class="paging" style="float:right;" v-model="listData.per_page"></count>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import User from '../../models/User.js';
import Post from '../../models/Post.js';
import Paging from '../Paging.vue';
import Count from '../Count.vue';

export default {
    props : {
        id : {
            type : [String, Number]
        },
    },
    data() {
        return {
            user : new User({ id: this.id }),
            posts : {},
            counts : [5, 10, 30],
            listData : {
                'total': 0,
                'per_page': 5,
                'current_page': 1,
            }
        }
    },
    mounted() {
        this.loadUser();
        this.loadPosts();
    },
    methods : {
        loadUser() {
            this.user.show().then(user => {console.log(user);
                this.user = user;
            });
        },
        loadPosts() {
            Post.index({
                'user_id' : this.id,
                'page' : this.listData.current_page,
                'count' : this.listData.per_page
            }).then(posts => {
                this.posts = posts.data;
                this.listData.total = posts.last_page;
            });
        },
    },
    watch : {
        'listData.current_page' : function(value){
            this.loadPosts();
        },
        'listData.per_page' : function(value){
            this.loadPosts();
        },
    },
    components : {
        paging : Paging,
        count : Count,
    }
}
</script>

<style scoped>
</style>
