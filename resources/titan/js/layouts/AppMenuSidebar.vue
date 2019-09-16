<template>
  <aside class="app-menu-sidebar menu bg-white border-r-2 h-full">
    <ul class="menu-list mt-2">
      <li v-for="(link, index) in links" :key="index">
        <RouterLink :to="{ name: link.name }" exact>{{ link.label }}</RouterLink>
      </li>
      <li>
        <a href="/v3/logout">Logout</a>
      </li>
    </ul>
  </aside>
</template>

<script>
export default {
  name: "AppMenuSidebar",
  status: "prototype",
  release: "1.0.0",
  data() {
    return {
      links: [
        {
          name: "parent-dashboard",
          label: "Parent Dashboard"
        },
        {
          name: "teacher-dashboard",
          label: "Teacher Dashboard"
        },
        {
          name: "edit-participant",
          label: "Edit Participant"
        },
        {
          name: "edit-profile",
          label: "Edit Profile"
        },
        {
          name: "easy-emailer",
          label: "Easy Emailer"
        }
      ]
    };
  },
  watch: {
    $route() {
      $(".app-menu-sidebar").removeClass("is-open");
    }
  }
};
</script>

<style lang="sass">
.app-menu-sidebar
    position: absolute
    top: 0
    width: 220px

    li
        border-bottom: 2px solid #C8D6E5

.page-content
    flex: 1
    transform: translate3d(0, 0, 0)
    transition: transform .3s

.app-menu-sidebar.is-open + .page-content
    transform: translate3d(220px, 0, 0)
</style>
