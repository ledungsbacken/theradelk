<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Post</div>

                    <div class="panel-body">
                        <img v-if="post.headImage" :src="post.headImage.data.desktop" />
                        <div v-html="post.data.content"></div>
                        <div>Title: {{ post.data.title }}</div>
                        <div>Author: {{ post.user.data.name }}</div>
                        <div>Slug: {{ post.data.slug }}</div>
                        <div>Views: {{ post.data.views }}</div>
                        <div>Posted: {{ post.dateToString(post.data.created_at) }}</div>
                        <div v-if="post.image"><img :src="post.image.url" /></div>
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
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props : {
        post : {
            type : [Object]
        },
    },
    data() {
        return {

        }
    },
    mounted() {

    },
    methods : {

    }
}
</script>

<style scoped>
</style>
