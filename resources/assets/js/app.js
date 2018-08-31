/* Load dependancies */
require('./bootstrap');
require('./components');

/* Vuex Store */
import store from "./store"

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    store
});
