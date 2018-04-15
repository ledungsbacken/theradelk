<template>
    <div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Sceneries</div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li
                            v-for="scenery in sceneries"
                            class="list-group-item">
                                {{ scenery.category ? scenery.category.data.name : 'Start Page' }}
                                <button
                                    class="btn btn-sm btn-primary fa fa-arrow-right float-right"
                                    @click="select(scenery)">
                                </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Scenery from '../../../../models/Scenery.js';

export default {
    props : {
        sceneries : {
            type : Array,
            required : true,
        }
    },
    data() {
        return {

        }
    },
    mounted() {

    },
    methods : {
        select(scenery) {
            this.$emit('select', scenery);
        },
    },
    components : {

    }
}
</script>

<style scoped>
</style>
