<template>
  <div class="app-container container">
    <AppMenuSidebar />

    <main class="page-content bg-white">
      <AppHeader />

      <Transition>
        <RouterView />
      </Transition>

      <AppFooter />
    </main>
  </div>
</template>

<script>
import AppFooter from './AppFooter'
import AppHeader from './AppHeader'
import AppMenuSidebar from './AppMenuSidebar'

export default {
  name: 'AppContainer',
  components: {
    AppFooter,
    AppHeader,
    AppMenuSidebar

  },
  computed: {
    programs () {
      return this.$store.state.User.programs
    }
  }
}
</script>
