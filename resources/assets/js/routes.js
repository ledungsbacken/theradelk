// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
const routes = [
    {
        path: '/',
        component: require('./app/admin/dashboard/Index.vue'),
        meta: {
            secure: true, // Requires to be logged in
        },
    },
    {
        path: '/post',
        component: require('./app/admin/posts/Index.vue'),
        meta: {
            secure: true, // Requires to be logged in
        },
    },
    {
        path: '/post/:id',
        component: require('./app/admin/editPost/Index.vue'),
        props: true,
        meta: {
            secure: true, // Requires to be logged in
        },
    },
    {
        path: '/create/post',
        component: require('./app/admin/createPost/Index.vue'),
        meta: {
            secure: true, // Requires to be logged in
        },
    },
    {
        path: '/category',
        component: require('./app/admin/categories/Index.vue'),
        meta: {
            secure: true, // Requires to be logged in
            role: 'super_admin',
        },
    },
    {
        path: '/category/:id',
        component: require('./app/admin/subcategories/Index.vue'),
        props: true,
        meta: {
            secure: true, // Requires to be logged in
            role: 'super_admin',
        },
    },
    {
        path: '/settings',
        component: require('./app/admin/settings/Index.vue'),
        meta: {
            secure: true, // Requires to be logged in
            role: ['admin', 'super_admin'],
        },
    },
    {
        path: '/file/upload',
        component: require('./app/admin/file/Upload.vue'),
        meta: {
            secure: true, // Requires to be logged in
        },
    },
    {
        path: '/user',
        component: require('./app/admin/users/Index.vue'),
        meta: {
            secure: true, // Requires to be logged in
            role: ['admin', 'super_admin'],
        },
    },
    {
        path: '/user/:id',
        component: require('./app/admin/user/Index.vue'),
        props: true,
        meta: {
            secure: true, // Requires to be logged in
            role: ['admin', 'super_admin'],
        },
    },
    {
        path: '/create/user',
        component: require('./app/admin/createUser/Index.vue'),
        props: true,
        meta: {
            secure: true, // Requires to be logged in
            role: ['admin', 'super_admin'],
        },
    },
    {
        path: '/profile',
        component: require('./app/admin/profile/Index.vue'),
        props: true,
        meta: {
            secure: true, // Requires to be logged in
            role: ['admin', 'super_admin', 'editor', 'moderator', 'noob'],
        },
    },
]
export default routes;
