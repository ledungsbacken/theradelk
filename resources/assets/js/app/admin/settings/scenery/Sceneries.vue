<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Settings</div>

                    <div class="panel-body">
                        <div class="panel-group">
                            <sceneries :sceneries="sceneries" @select="select"></sceneries>
                            <scenery-component :scenery="currentScenery" @select="openPostsModal"></scenery-component>
                            <posts-modal
                                v-if="showPostsModal"
                                :show="showPostsModal"
                                :category_id="currentScenery.category ? currentScenery.category.data.id : null"
                                @select="selectPost"
                                @close="showPostsModal = false">
                            </posts-modal>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Scenery from '../../../../models/Scenery.js';
import Sceneries from './List.vue';
import SceneryComponent from './Scenery.vue';
import PostsModal from './PostsModal.vue';

export default {
    data() {
        return {
            sceneries : [],
            currentScenery : new Scenery(),
            currentPost : '',
            showPostsModal : false,
        }
    },
    mounted() {
        this.load();
    },
    methods : {
        load() {
            Scenery.index().then(sceneries => {
                this.sceneries = sceneries;
                if(this.sceneries.length > 0) {
                    this.select(this.sceneries[0]);
                }
            });
        },
        select(scenery) {
            this.currentScenery = scenery;
        },
        openPostsModal(postToUpdate) {
            this.currentPost = postToUpdate;
            this.showPostsModal = true;
        },
        selectPost(post) {
            this.showPostsModal = false;
            this.currentScenery.data[this.currentPost] = post.data.id;
            this.currentScenery.update().then(scenery => {
                this.select(scenery);
            });
        },
    },
    components : {
        Sceneries,
        SceneryComponent,
        PostsModal,
    }
}
</script>

<style scoped>
</style>
