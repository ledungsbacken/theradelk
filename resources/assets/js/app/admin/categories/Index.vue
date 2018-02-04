<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Manage categories</div>

                    <div class="panel-body">
                        <i class="btn btn-success btn-lg fa fa-plus"
                            @click="addCategory"></i>
                        <new-category
                            v-if="new_category"
                            :cat="new_category"
                            @newCategory="newCategory"
                            @cancel="cancel"></new-category>
                        <div v-for="category in categories" :key="category.id">
                            <category :cat="category"></category>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Category from '../../../models/Category.js';
import CategoryComponent from './Category.vue';
import NewCategoryComponent from './NewCategory.vue';

export default {
    data() {
        return {
            categories : [],
            new_category : false,
        }
    },
    mounted() {
        this.load();
    },
    methods : {
        load() {
            Category.index().then(response => {
                this.categories = response;
            });
        },
        addCategory() {
            this.new_category = new Category();
        },
        newCategory() {
            this.new_category = false;
            this.categories = [];
            this.load();
        },
        cancel(category) {
            this.new_category = false;
        },
    },
    components : {
        Category : CategoryComponent,
        NewCategory : NewCategoryComponent,
    }
}
</script>

<style scoped>
</style>
