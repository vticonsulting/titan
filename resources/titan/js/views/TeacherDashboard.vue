<template>
  <section class="teacher-dashboard-view section is-paddingless">
    <TeacherDashboardLayout v-for="(program, index) in programs" :key="index" :program="program"/>
  </section>
</template>

<script>
import TeacherDashboardLayout from "../layouts/TeacherDashboardLayout";

export default {
  name: "TeacherDashboardView",
  status: "prototype",
  release: "1.0.0",
  components: {
    TeacherDashboardLayout
  },
  computed: {
    programs() {
      return this.$store.state.User.programs;
    }
  }
};
</script>
