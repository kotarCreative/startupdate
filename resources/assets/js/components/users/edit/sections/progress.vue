<template>
  <div id="edit-progress-section">
    <h2>My Progress</h2>
    <div class="progress-updates">
      <progress-update v-for="(update, idx) in progressUpdates" :update="update" @edit="editUpdate" :key="'update-' + idx" :idx="idx"></progress-update>
    </div>
  </div>
</template>

<script>
  import ProgressUpdate from '../partials/progress';

  export default {
    name: 'edit-progress-section',

    components: {
      ProgressUpdate
    },

    props: {
      progressUpdates: {
        type: Array
      }
    },

    methods: {
      editUpdate() {

      }
    }
  }
</script>
