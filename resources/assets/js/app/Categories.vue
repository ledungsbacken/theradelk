<template>
    <div>
        <ul>
            <li v-for="category in categories">
                <router-link :to="'/post/category/'+category.data.slug">{{ category.data.name }}</router-link>
            </li>
        </ul>
    </div>
</template>

<script>
import Category from '../models/Category.js';

export default {
    data() {
        return {
            categories : {},
        }
    },
    mounted() {
        this.load();
    },
    methods : {
        load() {
            Category.index().then(categories => {
                this.categories = categories;
            });
        },
    },
}
</script>

<style scoped>
</style>
