// Companies
const companies = './components/companies/';
Vue.component('companies-table', require(companies + 'all/table.vue'));

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
import { faUserCircle } from '@fortawesome/free-regular-svg-icons'
import { faLink } from '@fortawesome/free-solid-svg-icons'
import { faSortDown } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faEdit);
library.add(faUserCircle);
library.add(faLink);
library.add(faSortDown);

Vue.component('font-awesome-icon', FontAwesomeIcon)
