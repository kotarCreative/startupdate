<template>
    <div class="company__table-wrapper">
        <filters></filters>
        <table class="table">
            <tbody>
                <row v-for="(company, idx) in companies" :company="company" :key="'company-' + idx"></row>
            </tbody>
            <tfoot v-if="loading">
                <td colspan="5" class="text-center"><loader></loader></td>
            </tfoot>
        </table>
    </div>
</template>

<script>
    import Filters from './filters';
    import Row from './row';

    export default {
        name: 'companies-table',

        components: {
            Filters,
            Row
        },

        props: {
          metrics: {
            type: Array
          },

          progressTypes: {
            type: Array
          },

          verticals: {
            type: Array
          }
        },

        mounted() {
          this.$store.commit('progressUpdates/setMetrics', this.metrics);
          this.$store.commit('companies/setProgressTypes', this.progressTypes);
          this.$store.commit('companies/setVerticals', this.verticals);
          this.$store.dispatch('companies/search');
          this.scroll();
        },

        computed: {
            companies() {
                return this.$store.getters['companies/all'];
            },

            loading() {
                return this.$store.getters.hasLoading('search-companies');
            }
        },

        methods: {
            scroll() {
                window.onscroll = () => {
                  let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight === document.documentElement.offsetHeight;

                  if (bottomOfWindow) {
                    this.$store.dispatch('companies/search', true);
                  }
                };
            }
        }
    }
</script>