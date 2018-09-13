<template>
  <div class="progress-update">
    <div class="progress-update__title">
      <h4>{{ new Date(update.created_at).format('m d, Y') }}</h4>
      <button v-if="!readOnly" class="btn text" @click="edit">
        <font-awesome-icon :icon="['far', 'edit']"></font-awesome-icon>
        Edit
      </button>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>Metric</th>
          <th>Value</th>
          <th>Growth</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td width="33%">
            <div class="inner-border">{{ update.metric }}</div>
          </td>
          <td width="33%">
            <div class="inner-border">{{ update.value }}</div>
          </td>
          <td width="33%">
            <div class="inner-border">{{ update.growth }}&#37;</div>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="progress-report__description">
      {{ update.description }}
    </div>
  </div>
</template>

<script>
  export default {
    name: 'progress-update',

    props: {
      readOnly: {
        type: Boolean,
        default: false
      },

      update: {
        type: Object,
        required: true
      }
    },

    methods: {
      edit() {
        this.$emit('edit', this.update);
      }
    }
  }
</script>

<style lang="scss">
  .progress-update {
    margin-bottom: 40px;
    padding-bottom: 40px;
    border-bottom: solid thin #ced4da;

    &:last-child {
      padding-bottom: 0px;
      border-bottom: none;
    }

    &__title {
      display: flex;
    }
  }
</style>
