<template>
    <div>
        <article class="col">
            <div class="hoverColors">
                <a :href="'/post/'+post.data.slug" class="posts">
                    <img :src="post.headImage.data.thumbnail" alt="">
                    <header>
                        <h2>{{ post.data.title }}</h2>
                        <p>{{ post.data.subtitle }}</p>
                    </header>
                </a>
                <ul class="inline" id="laptop">
                    <li>
                        by <strong>
                                <a :href="'/user/' + post.user.data.id">
                                    {{ post.user.data.name }}
                                </a>
                            </strong> in 
                            <strong>
                                <div v-for="subcategory in post.subcategories">
                                    <a :href="'/category/' + subcategory.category.data.slug">
                                        {{ subcategory.category.data.name }}
                                    </a>
                                </div>
                            </strong>
                        </li>
                    <li>{{ post.dateToString(post.data.published) }}</li>
                </ul>
                <ul class="inline" id="mobile">
                    <li>
                        <strong>
                            <a :href="'/user/' + post.user.data.id">
                                {{ post.user.data.name }}
                            </a>
                        </strong>
                    </li>
                    <li>{{ post.dateToString(post.data.published) }}</li>
                </ul>
            </div>
        </article>
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
