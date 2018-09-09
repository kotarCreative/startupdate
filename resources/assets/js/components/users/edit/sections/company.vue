<template>
  <div id="edit-company-section">
    <h2>Edit Company</h2>
    <div class="form-group">
      <photo-uploader @photoUploaded="updateCompanyPhoto" :starting-image="company.image" @removePhoto="removePhoto"></photo-uploader>
    </div>
    <div class="form-group">
      <label for="name" class="required-field">Company Name</label>
      <input type="text" class="form-control md" :class="{ 'has-error': hasError('name')}" name="name" v-model="form.name" :disabled="loading">
    </div>
    <div class="form-group">
      <label for="url">Company Url</label>
      <input type="text" class="form-control md" name="url" v-model="form.url" :disabled="loading">
      <div class="input-notice">Company URL (if you have one). Include the protocol, e.g. https://example.com</div>
    </div>
    <div class="form-group">
      <label for="email">Contact Email</label>
      <input type="text" class="form-control md" name="email" v-model="form.email" :disabled="loading">
      <div class="input-notice">Contact Email (optional). Creates a link on your profile so other startups can contact you.</div>
    </div>
    <div class="form-group">
      <label for="city" class="required-field">City</label>
      <input type="text" class="form-control md" :class="{ 'has-error': hasError('city')}" name="city" v-model="form.city" :disabled="loading">
      <div class="input-notice">Where is the company based?</div>
    </div>
    <div class="form-group">
      <label for="country" class="required-field">Country</label>
      <input type="text" class="form-control md" :class="{ 'has-error': hasError('country')}" name="country" v-model="form.country" :disabled="loading">
      <div class="input-notice">Please use the full spelling of the country for search purposes.</div>
    </div>
    <div class="form-group">
      <label for="description" class="required-field">Describe your company in a sentence or two.</label>
      <input type="text" class="form-control md" :class="{ 'has-error': hasError('description')}" name="description" v-model="form.description" :disabled="loading">
      <div class="input-notice">Keep it short. e.g. Platform for peer-to-peer car rentals.</div>
    </div>
    <div class="form-group">
      <label for="vertical" class="required-field">Vertical</label>
      <select name="vertical"
              class="form-control md"
              :class="{ 'has-error': hasError('vertical_id')}"
              v-model="form.vertical_id"
              :disabled="loading">
        <option :value="null">Select...</option>
        <option v-for="option in verticals" :value="option.id">{{ option.name }}</option>
      </select>
    </div>
    <div class="form-group">
      <label for="progress-type" class="required-field">Which of the following best describes your progress?</label>
      <select name="progress-type"
              class="form-control md"
              :class="{ 'has-error': hasError('progress_type_id')}"
              v-model="form.company_progress_type_id"
              :disabled="loading">
        <option :value="null">Select...</option>
        <option v-for="option in progressTypes" :value="option.id">{{ option.name }}</option>
      </select>
    </div>
    <div class="form-group">
      <label for="from-startup-school" class="required-field">Are you currently attending Y Combinator's Startup School?</label>
      <select name="from-startup-school"
              class="form-control md"
              :class="{ 'has-error': hasError('from_startup_school')}"
              v-model="form.from_startup_school"
              :disabled="loading">
        <option :value="0">No</option>
        <option :value="1">Yes</option>
      </select>
    </div>
    <div class="form-errors" v-if="hasErrors()">
        <sup>*</sup>Please fill in required fields.
    </div>
    <div class="form-group">
      <button class="btn primary" @click="save" :disabled="loading">Save</button>
      <loader v-if="loading"></loader>
    </div>
  </div>
</template>

<script>
  import ErrorMixins from '../../../../mixins/error-mixins';
  import PhotoUploader from '../../../general/photo-uploader';

  export default {
    name: 'edit-company-section',

    components: {
      PhotoUploader
    },

    mixins: [ErrorMixins],

    props: {
      company: {
        type: Object
      }
    },

    mounted() {
      Object.keys(this.form).forEach(k => {
          this.form[k] = this.company[k];
        });
    },

    data: _ => ({
      errorModel: 'companies',
      form: {
        name: null,
        url: null,
        email: null,
        city: null,
        country: null,
        description: null,
        vertical_id: null,
        company_progress_type_id: null,
        from_startup_school: 0,
        image: null
      }
    }),

    computed: {
      loading() {
        return this.$store.getters.hasLoading('update-company');
      },

      progressTypes() {
        return this.$store.getters['companies/progressTypes'];
      },

      verticals() {
        return this.$store.getters['companies/verticals'];
      }
    },

    methods: {
      removePhoto() {
        this.form.image = null;
      },

      updateCompanyPhoto(file) {
        this.form.image = file;
      },

      save() {
        this.$store.dispatch('companies/update', this.form);
      }
    }
  }
</script>
