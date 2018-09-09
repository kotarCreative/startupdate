// General
const general = './components/general/';
Vue.component('active-user', require(general + 'active-user.vue'));
Vue.component('photo-uploader', require(general + 'photo-uploader.vue'));
Vue.component('loader', require(general + 'loader.vue'));

// Users
const users = './components/users/';
Vue.component('edit-user-profile', require(users + 'edit/index.vue'));

// FontAwesome
import { library } from '@fortawesome/fontawesome-svg-core'
import { faEdit } from '@fortawesome/free-regular-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faEdit);

Vue.component('font-awesome-icon', FontAwesomeIcon)
