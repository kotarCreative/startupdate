import {
    JSONToFormData
} from '../helpers/formDataBuilder';

// Namespaced
const namespaced = true;

const ERROR_MODEL = 'companies';

const COMPANY = {
  id: null,
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
  active: COMPANY,
  all: [],
  metrics: [],
  nextPage: null,
  progressTypes: [],
  search: {
    filter: null,
    progress: null,
    term: null,
    type: 'company',
    vertical: null
  },
  verticals: []
}

// Getters
const getters = {
  active: state => state.active,
  all: state => state.all,
  progressTypes: state => state.progressTypes,
  search: state => state.search,
  verticals: state => state.verticals
}

// Actions
const actions = {
  search({
    commit,
    dispatch,
    state
  }, next = false) {
    var loader = 'search-companies';
    commit('addLoading', loader, {
      root: true
    });

    var url = '/companies';

    if (next) {
      url = state.nextPage;
    }
    return axios.get(url, { params: state.search })
      .then(response => {
        if (next) {
          commit('add', response.data.data);
        } else {
          commit('setAll', response.data.data);
        }
        commit('setPagination', response.data);
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
  },

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
  add(state, companies) {
    companies.forEach(c => {
      state.all.push(c);
    });
  },

  setActive(state, company) {
    state.active = company;
  },

  setAll(state, companies) {
      state.all = companies;
  },

  setMetrics(state, metrics) {
    state.metrics = metrics;
  },

  setPagination(state, response) {
    state.nextPage = response.next_page_url;
  },

  setProgressTypes(state, types) {
    state.progressTypes = types;
  },

  setVerticals(state, verticals) {
    state.verticals = verticals;
  }
}

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
}
