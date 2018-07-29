import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const SidebarView = require('./views/HomeView');

let router = new VueRouter({
    routes: [
        {
            path: '/',
            component: require('./views/HomeView'),
            children: [
                {
                    name: 'Home',
                    path: '/',
                    component: require('./views/Sidebar/Default'),
                    meta: {
                        hasSidebar:true
                    }
                },
                {
                    path: '/search/:query?,:type?,:street?',
                    name: 'Search',
                    component: require('./views/Sidebar/Search'),
                    meta: {
                        hasSidebar:true,
                        showBackBtn: true
                    }
                },
                {
                    path: '/side/:id-:slug',
                    name: 'SidebarEntity',
                    component: require('./views/Sidebar/Entity'),
                    meta: {
                        hasSidebar:true,
                        showBackBtn: true
                    }
                }
            ]
        },

        {
            path: '/p,:id,:slug',
            name: 'EntityView',
            component: require('./views/EntityView'),
            meta: {
                showBackBtn: true
            }
        },
        {
            path: '/a,:id,:slug',
            name: 'PostView',
            component: require('./views/PostView')
        },
        {
            path: '/natezenia',
            component: require('./views/IntensityView'),
            children: [
                {
                    path: '/natezenia/',
                    name: 'IntensityIndexView',
                    component: require('./views/Sidebar/IntensityList'),
                    meta: {hasSidebar:true}
                },
                {
                    path: '/natezenia/:key',
                    name: 'IntesityView',
                    component: require('./views/Sidebar/Intensity'),
                    meta: {hasSidebar:true}
                }
            ]
        },
        {
            path: '/wydarzenia',
            name: 'EventsIndexView',
            component: require('./views/EventIndexView'),
            children: []
        },
        {
            path: '/zglos',
            name: 'EventsCreateView',
            component: require('./views/EventsCreateView'),
            children: []
        },
        {
            path: '/w/:id-:slug',
            name: 'EventView',
            component: require('./views/EventView')
        },
        {
            path: '/aktualnosci',
            name: 'PostsIndexView',
            component: require('./views/PostsIndexView')
        },
        {
            path: '/:slug',
            name: 'PageView',
            component: require('./views/PageView')
        },
    ],

    scrollBehavior(to, from, savedPosition){
        return { x: 0, y: 0 }
    }
});
export default router;
