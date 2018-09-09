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
  all: [],
  metrics: [],
}

// Getters
const getters = {
  active: state => state.active,
  all: state => state.all,
  metrics: state => state.metrics
}

// Actions
const actions = {
  create({
    commit,
    dispatch,
    rootGetters
  }, update) {
    var loader = 'add-progress-update';
    commit('addLoading', loader, {
      root: true
    });

    return new Promise((resultFn, errorFn) => {
      axios.post('/companies/' + rootGetters['companies/active'].slug + '/progress', update)
        .then(response => {
          commit('add', response.data.progress_update);
          if (resultFn) {
            resultFn(response);
          }
          dispatch('finishAjaxCall', {
            loader: loader,
            response: response,
            model: ERROR_MODEL
          }, {
            root: true
          });
        })
        .catch(errors => {
          if(errorFn) {
            errorFn(errors);
          }
          dispatch('finishAjaxCall', {
            loader: loader,
            response: errors,
            model: ERROR_MODEL
          }, {
            root: true
          });
        });
    });
  },

  update({
    state,
    commit,
    dispatch,
    rootGetters
  }, update) {
    var loader = 'update-progress-update';
    commit('addLoading', loader, {
      root: true
    });

    return new Promise((resultFn, errorFn) => {
      axios.patch('/companies/' + rootGetters['companies/active'].slug + '/progress/' + update.id, update)
        .then(response => {
          commit('update', response.data.progress_update);

          if (resultFn) {
            resultFn(response);
          }
          dispatch('finishAjaxCall', {
            loader: loader,
            response: response,
            model: ERROR_MODEL
          }, {
            root: true
          });
        })
        .catch(errors => {
          if(errorFn) {
            errorFn(errors);
          }
          dispatch('finishAjaxCall', {
            loader: loader,
            response: errors,
            model: ERROR_MODEL
          }, {
            root: true
          });
        });
    });
  }
}

// Mutations
const mutations = {
  add(state, update) {
    state.all.push(update);
  },

  resetActive(state) {
    state.active = UPDATE;
  },

  setActive(state, update) {
    state.active = update;
  },

  setAll(state, updates) {
    state.all = updates;
  },

  setMetrics(state, metrics) {
    state.metrics = metrics;
  },

  update(state, update) {
    let existing = state.all.find(u => u.id === update.id);

    if (existing) {
      Object.keys(existing).forEach(k => {
        existing[k] = update[k];
      });
    }
  }
}

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
}
