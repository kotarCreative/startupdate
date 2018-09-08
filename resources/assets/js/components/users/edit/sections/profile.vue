<template>
  <div id="edit-profile-section">
    <h2>Profile Info</h2>
    <div class="form-group">
      <label for="first-name" class="required-field">First Name</label>
      <input type="text" class="form-control md" :class="{ 'has-error': hasError('current_password')}" name="first-name" v-model="form.first_name" :disabled="loading">
    </div>
    <div class="form-group">
      <label for="last-name">Last Name</label>
      <input type="text" class="form-control md" name="last-name" v-model="form.last_name" :disabled="loading">
    </div>
    <h2>Login Info</h2>
    <div class="form-group">
      <label for="email">Login Email</label>
      <input type="text" class="form-control md" name="email" v-model="form.email" :disabled="loading">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control md" name="password" v-model="form.password" :disabled="loading">
      <div class="input-notice">Leave it blank if you don't want to change it.</div>
    </div>
    <div class="form-group">
      <label for="password_confirmation">Password Confirmation</label>
      <input type="password" class="form-control md" name="password_confirmation" v-model="form.password_confirmation" :disabled="loading">
    </div>
    <div class="form-group">
      <label for="current_password" class="required-field">Current Password</label>
      <input type="password" class="form-control md" :class="{ 'has-error': hasError('current_password')}" name="current_password" v-model="form.current_password" :disabled="loading">
      <div class="input-notice">We will need your current password to confirm you changes.</div>
    </div>
    <div class="form-errors" v-if="hasErrors()">
        <sup>*</sup>Please fill in required fields.
    </div>
    <div class="form-group">
      <button class="btn primary" @click="save" :disabled="loading">Update</button>
    </div>
  </div>
</template>

<script>
  import ErrorMixins from '../../../../mixins/error-mixins';

  export default {
    name: 'edit-profile-section',

    mixins: [ErrorMixins],

    props: {
      profile: {
        type: Object
      }
    },


    mounted() {
      Object.keys(this.form).forEach(k => {
          this.form[k] = this.profile[k];
        });
    },

    data: _ => ({
      errorModel: 'users',
      form: {
        email: null,
        first_name: null,
        last_name: null,
        password: null,
        password_confirmation: null,
        current_password: null
      }
    }),

    computed: {
      loading() {
        this.$store.getters.hasLoading('update-profile');
      }
    },

    methods: {
      save() {
        this.$store.dispatch('users/update', this.form);
      }
    }
  }
</script>
