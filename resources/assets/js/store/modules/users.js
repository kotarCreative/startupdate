// Namespaced
const namespaced = true;

const ERROR_MODEL = 'users';

const USER = {
  slug: null,
  first_name: null,
  last_name: null,
  email: null,
  created_at: null,
  updated_at: null
}

// State
const state = {
  active: USER
}

// Getters
const getters = {

}

// Actions
const actions = {
  update({
    state,
    commit,
    dispatch
  }, user) {
    var loader = 'update-profile';
    commit('addLoading', loader, {
      root: true
    });

    return axios.patch('/profile/' + state.active.slug, user)
      .then(response => {
        dispatch('finishAjaxCall', {
          loader: loader,
          response: response,
          model: ERROR_MODEL
        }, {
          root: true
        });
      })
      .catch(errors => {
        dispatch('finishAjaxCall', {
          loader: loader,
          response: errors,
          model: ERROR_MODEL
        }, {
          root: true
        });
      });
  }
}

// Mutations
const mutations = {
  setActive(state, user) {
    state.active = user;
  }
}

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
}
