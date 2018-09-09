<template>
  <div id="edit-progress-section">
    <div class="row align-items-center">
      <div class="col">
        <h2>My Progress</h2>
      </div>
      <div class="col ml-auto flex-grow-0">
        <button class="btn text" @click="addUpdate">
          &#43; Add Update
        </button>
      </div>
    </div>
    <div class="progress-updates">
      <progress-update v-for="(update, idx) in progressUpdates" :update="update" @edit="editUpdate" :key="'update-' + idx" :idx="idx"></progress-update>
    </div>
    <add-progress-modal></add-progress-modal>
    <edit-progress-modal :progress-update="activeUpdate"></edit-progress-modal>
  </div>
</template>

<script>
  import AddProgressModal from '../partials/add-progress-modal';
  import EditProgressModal from '../partials/edit-progress-modal';
  import ProgressUpdate from '../partials/progress';

  export default {
    name: 'edit-progress-section',

    components: {
      AddProgressModal,
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
      addUpdate() {
        this.$modals.show('add-progress');
      },

      editUpdate(update) {
        this.$modals.show('edit-progress');
        this.$store.commit('progressUpdates/setActive', update);
      }
    }
  }
</script>
