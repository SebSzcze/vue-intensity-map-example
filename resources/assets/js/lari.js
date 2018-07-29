/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue';
import axios from 'axios';

window.Vue = Vue;

import lari from 'lari';
import editr from 'editr';
import components from 'lari-datatable';
import SimpleTooltip from 'lari-simple-tooltip';

Vue.use(lari);
Vue.use(editr);
Vue.use(SimpleTooltip);
Vue.prototype.$http = axios;

require('./components/Google/load');

import Select from './lari/Select'
// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */

Vue.component('color-picker', require('./lari/ColorPicker'));
Vue.component('googlemap-create-marker', require('./components/Google/MarkerCreator'));
Vue.component('lari-datepicker', require('./lari/Datepicker.vue'));
Vue.component('lari-data-table', components.LariDataTable);
Vue.component('v-select', Select);
Vue.component('v-options', require('./lari/OptionsArray'));
Vue.component('menu-manager', require('./components/Menu/MenuManager'));
Vue.component('attachments', require('./lari/Attachments'));

import VueQuillEditor from 'vue-quill-editor'

// require styles
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'

Vue.use(VueQuillEditor, {
    modules: {
        toolbar: [
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            ['blockquote', 'code-block'],

            [{'header': 1}, {'header': 2}],               // custom button values
            [{'list': 'ordered'}, {'list': 'bullet'}],
            [{'script': 'sub'}, {'script': 'super'}],      // superscript/subscript
            [{'indent': '-1'}, {'indent': '+1'}],          // outdent/indent
            [{'direction': 'rtl'}],                         // text direction

            [{'size': ['small', false, 'large', 'huge']}],  // custom dropdown
            [{'header': [1, 2, 3, 4, 5, 6, false]}],

            [{'color': []}, {'background': []}],          // dropdown with defaults from theme
            [{'font': []}],
            [{'align': []}],

            ['clean']                                         // remove formatting button
        ]
    }
})

let app = new Vue({
    el: '#app',
});
