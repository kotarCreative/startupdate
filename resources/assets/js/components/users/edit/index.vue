<template>
  <div id="users-profile">
    <ul class="tabs">
      <li class="tab-item" :class="{active: selectedSection === 'profile'}" @click="toggleSection('profile')">
        Profile Info
      </li>
      <li class="tab-item" :class="{active: selectedSection === 'company'}" @click="toggleSection('company')">
        Company
      </li>
      <li class="tab-item" :class="{active: selectedSection === 'progress'}" @click="toggleSection('progress')">
        Progress
      </li>
    </ul>
    <component :is="sections[selectedSection]" :profile="profile" :company="company"></component>
  </div>
</template>

<script>
  import CompanySection from './sections/company';
  import ProfileSection from './sections/profile';
  import ProgressSection from './sections/progress';

  export default {
    name: 'user-profile',

    components: {
      CompanySection,
      ProfileSection,
      ProgressSection
    },

    props: {
      company: {
        type: [Object, Array]
      },

      metrics: {
        type: Array
      },

      profile: {
        type: Object
      },

      progressTypes: {
        type: Array
      },

      verticals: {
        type: Array
      }
    },

    mounted() {
      this.$store.commit('companies/setActive', this.company);
      this.$store.commit('progressUpdates/setMetrics', this.metrics);
      this.$store.commit('progressUpdates/setAll', this.company.progress_updates);
      this.$store.commit('companies/setProgressTypes', this.progressTypes);
      this.$store.commit('companies/setVerticals', this.verticals);
    },

    data: _ => ({
      sections: {
        company: CompanySection,
        profile: ProfileSection,
        progress: ProgressSection
      },

      selectedSection: 'company'
    }),

    methods: {
      toggleSection(section) {
        this.selectedSection = section;
      }
    }
  }

</script>
