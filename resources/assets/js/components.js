// General
const general = './components/general/';
Vue.component('active-user', require(general + 'active-user.vue'));
Vue.component('photo-uploader', require(general + 'photo-uploader.vue'));

// Users
const users = './components/users/';
Vue.component('edit-user-profile', require(users + 'edit/index.vue'));
