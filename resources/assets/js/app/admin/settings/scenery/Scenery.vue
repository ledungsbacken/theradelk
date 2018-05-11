<template>
    <div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Scenery for {{ scenery.category ? scenery.category.data.name : 'Start Page' }}
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Post</th>
                                <th>Choosen</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>First</td>
                                <td>{{ scenery.firstPost ? scenery.firstPost.data.title : '' }}</td>
                                <td>
                                    <button class="btn btn-sm btn-success" @click="select('first_post_id')">
                                        Choose
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Second</td>
                                <td>{{ scenery.secondPost ? scenery.secondPost.data.title : '' }}</td>
                                <td>
                                    <button class="btn btn-sm btn-success" @click="select('second_post_id')">
                                        Choose
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Third</td>
                                <td>{{ scenery.thirdPost ? scenery.thirdPost.data.title : '' }}</td>
                                <td>
                                    <button class="btn btn-sm btn-success" @click="select('third_post_id')">
                                        Choose
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Post from '../../../../models/Post.js';

export default {
    props : {
        scenery : {
            type : Object,
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
        select(postToUpdate) {
            this.$emit('select', postToUpdate);
        },
    },
    components : {

    }
}
</script>

<style scoped>
</style>
