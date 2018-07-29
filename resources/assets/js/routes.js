import VueRouter from 'vue-router';
Vue.use(VueRouter);

let routes = [
    {
        path: '/',
        name: 'home',
        component: require('./Modules/Home')
    },
    {
        path: '/natezenia',
        name: 'intensity',
        component: require('./Modules/Intensity')
    },
    {
        path: '/natezenia,:name',
        name: 'intensityOption',
        component: require('./Modules/Intensity')
    },
    {
        path: '/zglos',
        name: 'newevent',
        component: require('./Modules/Proposition')
    },
    {
        path: '/aktualnosci',
        name: 'posts',
        component: require('./Modules/Posts')
    },
    {
        path: '/wydarzenia',
        name: 'events',
        component: require('./Modules/Home')
    },
    {
        path: '/projekty',
        name: 'projects',
        component: require('./Modules/Home')
    },
    {
        path: '/filter',
        name: 'filter',
        component: require('./Modules/Home')
    },
    {
        path: '/side,:id,:slug',
        name: 'sidebar',
        component: require('./Modules/Home')
    },
    {
        path: '/entity,:id,:slug',
        name: 'entity',
        component: require('./Modules/Entity')
    },
    {
        path: '/event,:id,:slug',
        name: 'event',
        component: require('./Modules/Event')
    },
    {
        path: '/a,:id,:slug',
        name: 'post',
        component: require('./Modules/Post')
    },
    {
        path: '/:slug',
        name: 'page',
        component: require('./Modules/Page')
    },
];

window.router = new VueRouter({
    routes
});
