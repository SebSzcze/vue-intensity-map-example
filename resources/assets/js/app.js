import Vue from 'vue';
import VueProgressBar from 'vue-progressbar';

Vue.use(VueProgressBar, {
    color: '#235C98',
    failedColor: 'red',
    height: '5px',
})


import store from './theme/store'
import router from './theme/router'
import event from './theme/utils/EventBus'
import maps from './theme/utils/GoogleMap'

Vue.use(event)
Vue.use(maps)


Vue.component('map-marker', require('./theme/elements/MapMarker'));
Vue.component('scrollbar', require('./theme/elements/ScrollBar'));
Vue.component('sidebar', require('./theme/elements/Sidebar'));
Vue.component('navigation', require('./theme/elements/Navigation'));

Vue.component('t-label', require('./theme/ui/TypeLabel'));
Vue.component('pin-marker', require('./theme/ui/PinMarker'));
Vue.component('btn-twitter', require('./theme/ui/TwitterBtn'));
Vue.component('btn-facebook', require('./theme/ui/FacebookBtn'));
Vue.component('btn-linkedin', require('./theme/ui/LinkedinBtn'));
Vue.component('btn-google', require('./theme/ui/GoogleBtn'));

Vue.component('policy-bar', require('./theme/elements/PolicyBar'));

const App = new Vue({
    store,
    router,

    created(){
        this.$store.dispatch('fetchSettings');
    }
}).$mount('#app')
