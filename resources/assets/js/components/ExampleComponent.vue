<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        I'm an example component!
                        <div>
                            id: {{ singlePost.data.id }}
                            <br />
                            Title: {{ singlePost.data.title }}
                            <br />
                            <span v-for="subcategory in singlePost.data.subcategories">subcategory: {{ subcategory.name }}
                                <br />&nbsp;&nbsp;&nbsp;&nbsp;Category: {{ subcategory.category.name }}<br />
                            </span>
                        </div>
                        <hr />
                        <div v-for="post in posts.data" style="padding-bottom:20px;">
                            <div>
                                id: {{ post.id }}
                                <br />
                                Title: {{ post.title }}
                                <br />
                                <span v-for="subcategory in post.subcategories">subcategory: {{ subcategory.name }}
                                    <br />&nbsp;&nbsp;&nbsp;&nbsp;Category: {{ subcategory.category.name }}<br />
                                </span>
                            </div>
                        </div>
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
                singlePost : {data:{}},
                posts : {}
            }
        },
        methods : {},
        mounted() {
            console.log('Component mounted.')
            axios.get('/api/post/2')
                .then(response => {
                    console.log(response);
                    this.singlePost = response;
                });
            axios.get('/api/post')
                .then(response => {
                    console.log(response);
                    this.posts = response;
                });
        }
    }
</script>

<style scoped>
</style>
