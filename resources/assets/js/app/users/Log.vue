<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Log</div>

                    <div class="panel-body">
                        <div v-for="log in logs.data">Time: {{ log.created_at }} User: {{ log.user.name }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            logs : {}
        }
    },
    mounted() {
        this.load();
    },
    methods : {
        load() {
            axios.get('/api/user/log').then(response => {
                this.logs = response;
            });
        }
    }
}
</script>

<style scoped>
</style>
