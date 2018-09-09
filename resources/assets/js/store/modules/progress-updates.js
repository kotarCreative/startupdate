import {
    JSONToFormData
} from '../helpers/formDataBuilder';

// Namespaced
const namespaced = true;

const ERROR_MODEL = 'progressUpdates';

const UPDATE = {
  company_id: null,
  progress_metric_id: null,
  other_metric: null,
  growth: null,
  value: null,
  description: null,
  created_at: null,
  updated_at: null
}

// State
const state = {
  active: UPDATE,
  metrics: [],
}

// Getters
const getters = {
  metrics: state => state.metrics
}

// Actions
const actions = {
  update({
    state,
    commit,
    dispatch
  }, update) {
    var loader = 'update-progress-update';
    commit('addLoading', loader, {
      root: true
    });

    var data = new FormData();
    data.append('_method', 'PATCH');
    JSONToFormData(data, update);

    return axios.post('/companies/' + state.active.company_id + '/progress/update', data)
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
  setActive(state, update) {
    state.active = update;
  },

  setMetrics(state, metrics) {
    state.metrics = metrics;
  }
}

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
}
