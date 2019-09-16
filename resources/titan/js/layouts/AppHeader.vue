<template>
  <header class="app-header">
    <SidebarToggles />

    <PageHeader v-if="$route.meta.title">{{ $route.meta.title }}</PageHeader>

    <!-- <ProgramHeader v-else :program="programs[0]"/> -->
  </header>
</template>

<script>
import PageHeader from "../components/pattern/PageHeader";
import ProgramHeader from "../components/pattern/ProgramHeader";
import SidebarToggles from "../components/pattern/SidebarToggles";

export default {
  name: "AppHeader",
  status: "prototype",
  release: "1.0.0",
  components: {
    PageHeader,
    ProgramHeader,
    SidebarToggles
  },
  computed: {
    programs() {
      return this.$store.state.User.programs;
    }
  }
};
</script>

<style>
.app-header {
  background: url('/assets/dashboard/images/desktop_header_background.jpg');
}
</style>
