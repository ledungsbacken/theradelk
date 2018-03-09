
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
        if(!User.isLoggedIn()) {
            window.location = '/';
        }
        if(to.meta.role) {
            if(Array.isArray(to.meta.role)) {
                let hasRole = false;
                to.meta.role.forEach(function(role) {
                    if(User.hasRole(role) || User.hasRole('super_admin')) {
                        hasRole = true;
                    }
                });
                if(!hasRole) {
                    window.location = '/';
                }
            } else {
                if(!User.hasRole(to.meta.role) && !User.hasRole('super_admin')) {
                    window.location = '/';
                }
            }
        }
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
Vue.component('nav-categories', require('./app/Categories.vue'));

const app = new Vue({
    router
}).$mount('#app');