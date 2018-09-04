<template>
  <div id="edit-profile-section">
    <h2>Login Info</h2>
    <div class="form-group">
      <label for="email">Login Email</label>
      <input type="text" class="form-control" name="email" v-model="form.email">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" v-model="form.password">
      <div class="input-notice">Leave it blank if you don't want to change it.</div>
    </div>
    <div class="form-group">
      <label for="password_confirmation">Password Confirmation</label>
      <input type="password" class="form-control" name="password_confirmation" v-model="form.password_confirmation">
    </div>
    <div class="form-group">
      <label for="current_password">Current Password</label>
      <input type="password" class="form-control" name="current_password" v-model="form.current_password">
      <div class="input-notice">We will need your current password to confirm you changes.</div>
    </div>
    <div class="form-group">
      <button class="btn primary" @click="save">Update</button>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'edit-profile-section',

    data: _ => ({
      form: {
        email: null,
        password: null,
        password_confirmation: null,
        current_password: null
      }
    }),

    methods: {
      save() {

      }
    }
  }
</script>
