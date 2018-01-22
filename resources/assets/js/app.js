
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import Vue from 'vue';

//https://router.vuejs.org/en/essentials/getting-started.html
import VueRouter from 'vue-router';

Vue.use(VueRouter);


// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
const router = new VueRouter({
    routes :  [
        { path: '*', redirect: '/post' },
        {
            path: '/post',
            component: require('./app/posts/Index.vue'),
        },
        {
            path: '/post/:slug',
            component: require('./app/post/Index.vue'),
            props : true
        },
        {
            path: '/create/post',
            component: require('./app/createPost/Index.vue')
        },
        {
            path: '/file/upload',
            component: require('./app/file/Upload.vue')
        },
        {
            path: '/user/log',
            component: require('./app/users/Log.vue')
        },
        {
            path: '/example',
            component: require('./components/ExampleComponent.vue')
        },
        {
            path: '/editor',
            component: require('./app/Ckeditor.vue')
        }
    ]
});



window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    router
}).$mount('#app');
