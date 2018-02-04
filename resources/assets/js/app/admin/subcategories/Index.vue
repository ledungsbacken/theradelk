<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Manage {{ category.data.name }}</div>

                    <div class="panel-body">
                        <i class="btn btn-success btn-lg fa fa-plus"
                            @click="addSubcategory"></i>
                        <new-subcategory
                            v-if="new_subcategory"
                            :cat="new_subcategory"
                            @newSubcategory="newSubcategory"
                            @cancel="cancel"></new-subcategory>
                        <div v-for="subcategory in subcategories" :key="subcategory.id">
                            <subcategory :cat="subcategory"></subcategory>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Category from '../../../models/Category.js';
import Subcategory from '../../../models/Subcategory.js';
import CategoryComponent from './Subcategory.vue';
import NewCategoryComponent from './NewSubcategory.vue';

export default {
    props : {
        id : {
            type : [Number, String],
            required : true,
        }
    },
    data() {
        return {
            category : new Category({ id: this.id }),
            subcategories : [],
            new_subcategory : false,
        }
    },
    mounted() {
        this.category.show().then(category => {
            this.category = category;
        });
        this.load();
    },
    methods : {
        load() {
            Subcategory.indexByCategory({ category_id: this.category.data.id }).then(response => {
                this.subcategories = response;
            });
        },
        addSubcategory() {
            this.new_subcategory = new Subcategory({ category_id: this.category.data.id });
        },
        newSubcategory() {
            this.new_subcategory = false;
            this.subcategories = [];
            this.load();
        },
        cancel(category) {
            this.new_subcategory = false;
        },
    },
    components : {
        Subcategory : CategoryComponent,
        NewSubcategory : NewCategoryComponent,
    }
}
</script>

<style scoped>
</style>
