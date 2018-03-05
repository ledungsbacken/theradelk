<template>
    <div>
        <div class="row">
            <div class="col-md-4">
                <input type="text" class="form-control" v-model="category.data.name" :readonly="readonly" />
            </div>
            <button class="btn btn-sm btn-primary"
                v-if="readonly"
                @click="readonly = false">
                    Edit
            </button>
            <router-link :to="'/category/' + category.data.id"
                v-if="readonly"
                @click="readonly = false">
                    <i class="btn btn-sm btn-success fa fa-arrow-right"></i>
            </router-link>
            <button class="btn btn-sm btn-warning"
                v-if="!readonly"
                @click="cancel">
                    Cancel
            </button>
            <button class="btn btn-sm btn-success"
                v-if="!readonly"
                @click="save">
                Save
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props : {
        cat : {
            type : Object,
            required : true,
        }
    },
    data() {
        return {
            category : this.cat,
            readonly : true,
        }
    },
    mounted() {

    },
    methods : {
        save() {
            this.readonly = true;
            this.category.update().then(response => {
                this.category = response;
            });
        },
        cancel() {
            this.readonly = true;
            this.category.reset();
        }
    },
}
</script>

<style scoped>
</style>
