<template>
    <div>
        <div>Title: {{ post.data.title }}</div>
        <div>Author: {{ post.user.data.name }}</div>
        <div>Views: {{ post.data.views }}</div>
        <div>Posted: {{ post.dateToString(post.data.published) }}</div>
        <div><a :href="'/post/'+post.data.slug">Link</a></div>
        <div v-for="subcategory in post.subcategories">
            Category:
            <a :href="'/category/' + subcategory.category.data.slug">
                {{subcategory.category.data.name}}
            </a>
            /
            <a :href="'/category/' + subcategory.category.data.slug + '/' + subcategory.data.slug">
                {{ subcategory.data.name }}
            </a>
        </div>
        <br />
    </div>
</template>

<script>
export default {
    props : {
        post : {
            type : Object,
            required : true,
        },
    },
}
</script>

<style scoped>
</style>
