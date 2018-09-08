import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

// Modules
import app from './modules/app'
import companies from './modules/companies'
import users from './modules/users'

export default new Vuex.Store({
    modules: {
      app,
      companies,
      users
    }
});
