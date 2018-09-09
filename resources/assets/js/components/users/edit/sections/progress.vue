<template>
  <div id="edit-progress-section">
    <h2>My Progress</h2>
    <div class="progress-updates">
      <progress-update v-for="(update, idx) in progressUpdates" :update="update" @edit="editUpdate" :key="'update-' + idx" :idx="idx"></progress-update>
    </div>
    <edit-progress-modal :progress-update="activeUpdate"></edit-progress-modal>
  </div>
</template>

<script>
  import EditProgressModal from '../partials/edit-progress-modal';
  import ProgressUpdate from '../partials/progress';

  export default {
    name: 'edit-progress-section',

    components: {
      EditProgressModal,
      ProgressUpdate
    },

    data: _ => ({
      activeUpdate: null
    }),

    computed: {
      progressUpdates() {
        return this.$store.getters['progressUpdates/all'];
      }
    },

    methods: {
      editUpdate(update) {
        this.$modals.show('edit-progress');
        this.$store.commit('progressUpdates/setActive', update);
      }
    }
  }
</script>
