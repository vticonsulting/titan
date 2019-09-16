<template>
  <section class="parent-dashboard-view section is-paddingless">
    <!-- <SwipeableCards/> -->
    <ParentDashboardLayout v-for="(program, index) in programs" :key="index" :program="program"/>
  </section>
</template>

<script>
import ParentDashboardLayout from "../layouts/ParentDashboardLayout";
// import SwipeableCards from "../../../js/components/SwipeableCards/SwipeableCards";

export default {
  name: "ParentDashboard",
  status: "prototype",
  release: "1.0.0",
  components: {
    ParentDashboardLayout
    // SwipeableCards
  },
  computed: {
    programs() {
      return this.$store.state.User.programs;
    }
  }
};
</script>
