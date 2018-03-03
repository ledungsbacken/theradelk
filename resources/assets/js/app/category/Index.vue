<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Posts</div>

                    <div class="panel-body">
                        <div v-for="post in posts">
                            <div>Title: {{ post.data.title }}</div>
                            <div>Author: {{ post.user.data.name }}</div>
                            <div><router-link :to="'/post/'+post.data.slug">Link</router-link></div>
                            <div v-for="subcategory in post.subcategories">Category: {{subcategory.category.data.name}}/{{ subcategory.data.name }}</div>
                            <br />
                        </div>
                        <paging v-model="listData.current_page" class="paging" style="float:left;" :total="listData.total"></paging>
                        <count :counts="counts" class="paging" style="float:right;" v-model="listData.per_page"></count>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Post from '../../models/Post.js';
import Paging from '../Paging.vue';
import Count from '../Count.vue';

export default {
    // props : {
    //
    // },
    data() {
        return {
            category : this.$route.params.category,
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
        this.load();
    },
    methods : {
        load() {
            Post.index({
                'category' : this.category,
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
            this.load();
        },
        'listData.per_page' : function(value){
            this.load();
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
