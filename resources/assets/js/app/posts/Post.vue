<template>
    <div>
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
</template>

<script>
export default {
    props : {
        post : {
            type : Object
        },
    },
}
</script>

<style scoped>
</style>
