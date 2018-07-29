
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
require('./storage');
require('./events');
require('./components/Google/load');

require('./routes');

Vue.component('section-events', require('./components/Sections/Events'));
Vue.component('section-streets', require('./components/Sections/Streets'));
Vue.component('section-latest-entities', require('./components/Sections/Latest'));
Vue.component('section-latest-posts', require('./components/Sections/Posts'));

Vue.component('partial-navigation', require('./components/Partials/Navigation'));
Vue.component('partial-sidebar-entities', require('./components/Partials/SidebarEntities'));
Vue.component('partial-sidebar-search', require('./components/Partials/SidebarSearch'));
Vue.component('intro-modal', require('./components/Modal/Intro'));
Vue.component('sidebar', require('./components/Partials/Sidebar'));

const App = new Vue({
    el: '#app',
    router,
    watch: {
        routeName($name){
            if($name == 'projects') {
                storage.fetchProjects()
            }
        }
    },
    computed: {
        entities() {
            return storage.entities;
        },
        mapStyle(){
            return {
                minHeight: `${window.innerHeight - 70}px`,
                height: `calc(100vh - 70px)`
            }
        },
        routeName(){
            return this.$route.name
        }
    },
    methods: {
        pushEntity(entity){
            router.push({ name: 'sidebar', params: { id: entity.id, slug: entity.slug } })
        },
    },
    beforeCreate(){
        storage.fetchSettings();
    },
    beforeMount(){
        if(this.$route.name == 'projects') {
            return storage.fetchProjects();
        }
        if(this.$route.name == 'home') {
            return storage.fetchEntities();
        }
    }
});
