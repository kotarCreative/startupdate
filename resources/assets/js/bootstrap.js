window.Vue = require('vue');

/* Vue Modal */
import VueModal from "vue2-modal";

Vue.use(VueModal);

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Redirects the current page to the given url.
 *
 * @param string url
 *
 * @return void
 */
function redirectTo(url, newTab) {
    if (newTab) {
        window.open('http://' + window.location.hostname + url, '_blank');
    } else {
        window.location.href = 'http://' +
        window.location.hostname +
        url;
    }
}
