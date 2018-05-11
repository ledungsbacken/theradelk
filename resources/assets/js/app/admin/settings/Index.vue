<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Settings</div>

                    <div class="panel-body">
                        <div class="panel-group">
                            <sceneries></sceneries>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Sceneries from './scenery/Sceneries.vue';

export default {
    data() {
        return {

        }
    },
    mounted() {

    },
    methods : {

    },
    components : {
        Sceneries,
    }
}
</script>

<style scoped>
</style>