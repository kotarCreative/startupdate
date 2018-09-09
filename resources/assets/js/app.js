/* Load dependancies */
require('./bootstrap');
require('./components');

/* Vuex Store */
import store from "./store"

const app = new Vue({
    el: '#app',
    store
});
