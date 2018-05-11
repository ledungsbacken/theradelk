<template>
    <modal v-if="show" width="80%" @close="$emit('close')">
        <div slot="header">
            <h4>Social Links</h4>
        </div>
        <div slot="body">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-4">
                        <select class="form-control" v-model="newSocialLink.data.type_id">
                            <option
                                v-for="socialLinkType in socialLinkTypes"
                                :value="socialLinkType.data.id">
                                {{ socialLinkType.data.label }}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Url"
                            v-model="newSocialLink.data.url" />
                    </div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-12">
                        <button
                            class="btn btn-md btn-success col-md-10 col-md-offset-1"
                            @click="store()">
                            Create
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row" v-for="socialLink in socialLinks">
                    <div class="col-md-1">{{ socialLink.type.data.label }}:</div>
                    <div class="col-md-9">{{ socialLink.data.url }}</div>
                    <div class="col-md-2">
                        <button class="btn btn-sm btn-danger" @click="destroy(socialLink)">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <div slot="footer">
            <button class="btn btn-sm btn-warning float-right" @click="$emit('close')">Close</button>
        </div>
    </modal>
</template>

<script>
import SocialLink from '../../models/SocialLink.js';
import SocialLinkType from '../../models/SocialLinkType.js';
import Modal from '../Modal.vue';

export default {
    props : {
        show : {
            type: Boolean,
            required: true
        },
        user : {
            type: Object,
            required: true
        },
    },
    data() {
        return {
            socialLinks : [],
            socialLinkTypes : [],
            newSocialLink : new SocialLink({ user_id : this.user.data.id }),
        }
    },
    mounted() {
        this.loadLinks();
        this.loadLinkTypes();
    },
    methods : {
        loadLinks() {
            SocialLink.index({
                user_id : this.user.data.id,
            }).then(response => {
                this.socialLinks = response.data;
            });
        },
        loadLinkTypes() {
            SocialLinkType.index().then(response => {
                this.socialLinkTypes = response.data;
            });
        },
        store() {
            return this.newSocialLink.store().then(socialLink => {
                this.loadLinks();
                this.newSocialLink = new SocialLink({ user_id : this.user.data.id });
            });
        },
        destroy(socialLink) {
            return socialLink.destroy().then(response => {
                this.loadLinks();
            });
        },
    },
    watch : {

    },
    components : {
        Modal : Modal,
    }
}
</script>

<style scoped>
</style>