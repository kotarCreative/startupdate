<template>
  <vue-modal name="add-progress" size="lg" :on-close="closeFn">
    <h2 slot="header">Add Progress Update</h2>
    <div class="form-group">
      <div class="row">
        <div class="col-md-4">
          <label for="metric" class="required-field">Metric</label>
          <select name="metric"
                  class="form-control"
                  :class="{ 'has-error': hasError('progress_metric_id')}"
                  v-model="form.progress_metric_id"
                  :disabled="loading">
            <option :value="null">Select...</option>
            <option v-for="option in metrics" :value="option.id">{{ option.name }}</option>
          </select>
        </div>
        <div class="col-md-4">
          <label for="value" class="required-field">Value</label>
          <input type="text" class="form-control" :class="{ 'has-error': hasError('value')}" name="value" v-model="form.value" :disabled="loading">
          <div class="input-notice">Total added last week.</div>
        </div>
        <div class="col-md-4">
          <label for="growth" class="required-field">Growth &#37;</label>
          <input type="text" class="form-control" :class="{ 'has-error': hasError('growth')}" name="growth" v-model="form.growth" :disabled="loading">
          <div class="input-notice">How much did you grow last week?</div>
        </div>
      </div>
    </div>
    <div v-if="form.progress_metric_id === 4" class="form-group">
      <label for="other-metric" class="required-field">Other Metric</label>
      <input type="text" class="form-control md" :class="{ 'has-error': hasError('other_metric')}" name="other-metric" v-model="form.other_metric" :disabled="loading">
    </div>
    <div class="form-group">
      <label for="description">Additional Information</label>
      <textarea class="form-control" name="description" v-model="form.description"></textarea>
    </div>
    <div class="form-errors" v-if="hasErrors()">
        <sup>*</sup>Please fill in required fields.
    </div>
    <div class="form-group">
      <button class="btn" @click="save">
        Submit
      </button>
      <loader v-if="loading"></loader>
    </div>
  </vue-modal>
</template>

<script>
  import ErrorMixins from '../../../../mixins/error-mixins';

  export default {
    name: 'add-progress-modal',

    mixins: [ErrorMixins],

    data: _ => ({
      errorModel: 'progressUpdates',
      form: {
        id: null,
        company_id: null,
        description: null,
        growth: null,
        progress_metric_id: null,
        other_metric: null,
        value: null
      }
    }),

    computed: {
      loading() {
        return this.$store.getters.hasLoading('create-progress-update');
      },

      metrics() {
        return this.$store.getters['progressUpdates/metrics'];
      }
    },

    methods: {
      closeFn() {
        this.clearErrors();
        this.$store.commit('progressUpdates/resetActive');
      },

      save() {
        this.$store.dispatch('progressUpdates/create', this.form)
          .then(r => {
            this.$modals.hide('add-progress');
          });
      }
    }
  }
</script>

