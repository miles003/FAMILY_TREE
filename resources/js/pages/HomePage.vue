<template>
  <div class="row">
    <div class="col-md-4">
      <ProfileComponent />
    </div>
    <div class="col-md-8">
      <FamilyComponent />
      <ChildComponent />
      <SiblingsComponent />
    </div>
  </div>
</template>
<script>
  import ProfileComponent from '../components/profile/ProfileComponent'
  import FamilyComponent from '../components/profile/FamilyComponent'
  import ChildComponent from '../components/profile/ChildComponent'
  import SiblingsComponent from '../components/profile/SiblingsComponent'
  export default {
    components: {
      ProfileComponent, FamilyComponent, ChildComponent, SiblingsComponent
    },
    data() {
      return {
        payload: {}
      }
    },
    created() {
      this.$store.dispatch('getUserData')
    }
  }
</script>