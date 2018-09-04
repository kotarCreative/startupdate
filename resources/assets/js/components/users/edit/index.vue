<template>
  <div id="users-profile">
    <ul class="tabs">
      <li class="tab-item" :class="{active: selectedSection === 'profile'}" @click="toggleSection('profile')">
        Login Info
      </li>
      <li class="tab-item" :class="{active: selectedSection === 'company'}" @click="toggleSection('company')">
        Company
      </li>
      <li class="tab-item" :class="{active: selectedSection === 'progress'}" @click="toggleSection('progress')">
        Progress
      </li>
    </ul>
    <component :is="sections[selectedSection]" :profile="profile"></component>
  </div>
</template>

<script>
  import CompanySection from './sections/Company';
  import ProfileSection from './sections/Profile';
  import ProgressSection from './sections/Progress';

  export default {
    name: 'user-profile',

    components: {
      CompanySection,
      ProfileSection,
      ProgressSection
    },

    props: {
      profile: {
        type: Object
      }
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
