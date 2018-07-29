window.axios = require('axios');

import Vue from 'vue';
import { Vue2Dragula } from 'vue2-dragula';
import {string} from './config'
window.string = string

Vue.use(Vue2Dragula);
window._ = require('lodash');

window.Vue = Vue;
Vue.prototype.$http = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');
window.csrf_token = token.content;

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrf_token;
} else {
    console.error('CSRF token not found');
}


require('./utils/eventBus');
require('./utils/storage');
require('./utils/flash');

import components from './components';

export default components