<template>
    <div id="company-search__filters" class="row">
        <div class="col-md-2 col-xs-3">
            <label for="search-type">Search By</label>
            <select id="search-type"
                    name="search-type"
                    class="form-control"
                    v-model="search.type"
                    @change="performSearch">
                <option value="company">Company Name</option>
                <option value="location">Location</option>
            </select>
        </div>
        <div class="col-md-2 col-xs-6">
            <label for="search">Search</label>
            <input type="text" class="form-control" v-model="search.term" @input="maybePerformSearch" />
        </div>
        <div class="col-md-2 col-xs-3 d-sm-none">
            <button>Filters <span class="company-search__filters-arrow" :class="{ open: filtersOpen }"></span></button>
        </div>
        <div class="mobile-separator"></div>
        <div class="col-md-2 col-xs-3">
            <label for="filter-type">Type</label>
            <select id="filter-type"
                    name="filter-type"
                    class="form-control"
                    v-model="search.filter"
                    @change="performSearch">
                <option :value="null">Show All</option>
                <option v-for="option in filterTypes" :value="option.value">{{ option.label }}</option>
            </select>
        </div>
        <div class="col-md-2 col-xs-3">
            <label for="vertical-type">Vertical</label>
            <select id="vertical-type"
                    name="vertical-type"
                    class="form-control"
                    v-model="search.vertical"
                    @change="performSearch">
                <option :value="null">Show All</option>
                <option v-for="option in verticalTypes" :value="option.id">{{ option.name }}</option>
            </select>
        </div>
        <div class="col-md-2 col-xs-3">
            <label for="progress-type">Progress</label>
            <select id="progress-type"
                    name="progress-type"
                    class="form-control"
                    v-model="search.progress"
                    @change="performSearch">
                <option :value="null">Show All</option>
                <option v-for="option in progressTypes" :value="option.id">{{ option.name }}</option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'company-filters',

        data: _ => ({
            filtersOpen: false,
            filterTypes: [
                {
                    label: 'Startup School Companies',
                    value: 'startup-school'
                }
            ],
            timeout: null
        }),

        computed: {
            progressTypes() {
                return this.$store.getters['companies/progressTypes'];
            },

            search() {
                return this.$store.getters['companies/search'];
            },

            verticalTypes() {
                return this.$store.getters['companies/verticals'];
            }
        },

        methods: {
            maybePerformSearch() {
              if (this.timeout) {
                clearTimeout(this.timeout);
              }
              this.timeout = setTimeout(_ => {
                  this.performSearch();
              }, 2000);
            },

            performSearch() {
                this.$store.dispatch('companies/search');
            }
        }
    }
</script>

<style lang="scss">
    #company-search__filters {
        margin-bottom: 20px;
    }
</style>