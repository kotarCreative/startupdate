import {
    JSONToFormData
} from '../helpers/formDataBuilder';

// Namespaced
const namespaced = true;

const ERROR_MODEL = 'companies';

const company = {
  vertical_id: null,
  progress_type_id: null,
  slug: null,
  name: null,
  email: null,
  url: null,
  city: null,
  country: null,
  description: null,
  from_startup_school: null,
  created_at: null,
  updated_at: null
}

// State
const state = {
  active: company
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
  }, company) {
    var loader = 'update-company';
    commit('addLoading', loader, {
      root: true
    });

    var data = new FormData();
    data.append('_method', 'PATCH');
    JSONToFormData(data, company);

    return axios.post('/companies/' + state.active.slug, data)
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
  setActive(state, company) {
    state.active = company;
  }
}

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
}
