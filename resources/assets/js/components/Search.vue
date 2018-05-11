<template>
    <div>
        <input type="text" id="search" placeholder="Search" v-model="search" @keydown.enter="doSearch()" required />
        <button class="btn btn-sm btn-primary fa fa-search"  @click="doSearch()"></button>
    </div>
</template>

<script>
    export default {
        props : {
            string : {
                type : [String, Number],
                default : '',
            },
        },
        data() {
            return {
                search : this.string,
            }
        },
        mounted() {

        },
        methods : {
            doSearch() {
                if(document.getElementById('search').reportValidity()) {
                    window.location.href="/search?q="+this.search;
                }
            },
        },
    }
</script>