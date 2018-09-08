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
    <component :is="sections[selectedSection]" :profile="profile"></component>
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
