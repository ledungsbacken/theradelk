
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

/**
 * Load in all frontend routes.
 */
import routes from './routes.js';

import User from './models/User.js';

Vue.use(VueRouter);

/**
 * Setup frontend router
 */
const router = new VueRouter({
    routes
});

router.beforeEach((to, from, next) => {
    // Check if route requires you to be logged in
    if(to.meta.secure) {
        // Check if is logged in
        let isLoggedIn = false;
        User.isLoggedIn().then(response => {
            isLoggedIn = response.status;
        });
    }
    next();
});

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    router
}).$mount('#app');
