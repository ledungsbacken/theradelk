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
    // { path: '*', redirect: '/post' },
    // {
    //     path: '/post',
    //     component: require('./app/posts/Index.vue'),
    // },
    // {
    //     path: '/post/:slug',
    //     component: require('./app/post/Index.vue'),
    //     props: true
    // },
    // {
    //     path: '/post/category/:category',
    //     component: require('./app/category/Index.vue'),
    //     props: true
    // },
    // {
    //     path: '/post/category/:category/:subcategory',
    //     component: require('./app/subcategory/Index.vue'),
    //     props: true
    // },
    // {
    //     path: '/user/:id',
    //     component: require('./app/user/Index.vue'),
    //     props: true
    // },
    // {
    //     path: '/admin',
    //     component: require('./app/admin/dashboard/Index.vue'),
    //     meta: {
    //         secure: true, // Requires to be logged in
    //     },
    // },
    // {
    //     path: '/admin/post',
    //     component: require('./app/admin/posts/Index.vue'),
    //     meta: {
    //         secure: true, // Requires to be logged in
    //     },
    // },
    // {
    //     path: '/admin/post/:id',
    //     component: require('./app/admin/editPost/Index.vue'),
    //     props: true,
    //     meta: {
    //         secure: true, // Requires to be logged in
    //     },
    // },
    // {
    //     path: '/admin/create/post',
    //     component: require('./app/admin/createPost/Index.vue'),
    //     meta: {
    //         secure: true, // Requires to be logged in
    //     },
    // },
    // {
    //     path: '/admin/category',
    //     component: require('./app/admin/categories/Index.vue'),
    //     meta: {
    //         secure: true, // Requires to be logged in
    //         role: 'super_admin',
    //     },
    // },
    // {
    //     path: '/admin/category/:id',
    //     component: require('./app/admin/subcategories/Index.vue'),
    //     props: true,
    //     meta: {
    //         secure: true, // Requires to be logged in
    //         role: 'super_admin',
    //     },
    // },
    // {
    //     path: '/admin/file/upload',
    //     component: require('./app/admin/file/Upload.vue'),
    //     meta: {
    //         secure: true, // Requires to be logged in
    //     },
    // },
    // {
    //     path: '/admin/user',
    //     component: require('./app/admin/users/Index.vue'),
    //     meta: {
    //         secure: true, // Requires to be logged in
    //         role: ['admin', 'super_admin'],
    //     },
    // },
    // {
    //     path: '/admin/user/:id',
    //     component: require('./app/admin/user/Index.vue'),
    //     props: true,
    //     meta: {
    //         secure: true, // Requires to be logged in
    //         role: ['admin', 'super_admin'],
    //     },
    // },
    // {
    //     path: '/admin/create/user',
    //     component: require('./app/admin/createUser/Index.vue'),
    //     props: true,
    //     meta: {
    //         secure: true, // Requires to be logged in
    //         role: ['admin', 'super_admin'],
    //     },
    // },
    // {
    //     path: '/admin/profile',
    //     component: require('./app/admin/profile/Index.vue'),
    //     props: true,
    //     meta: {
    //         secure: true, // Requires to be logged in
    //         role: ['admin', 'super_admin', 'editor', 'moderator', 'noob'],
    //     },
    // },
    // {
    //     path: '/admin/user/log',
    //     component: require('./app/admin/users/Log.vue'),
    //     meta: {
    //         secure: true, // Requires to be logged in
    //     },
    // },
    // {
    //     path: '/example',
    //     component: require('./components/ExampleComponent.vue'),
    // }
]
export default routes;
