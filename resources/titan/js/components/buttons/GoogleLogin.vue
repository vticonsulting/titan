<template>
  <a
    id="google"
    :href="'/v3/oauth/redirect/google/' + $store.state.user_type"
    class="btn btn-social-login text-14 btn-round py-2 d-block mw-200px mx-auto mb-4 btn-drop-shadow"
  >
    <img
      :alt="lang.google_logo"
      class="login-logo mr-10"
      src="/assets/dashboard/images/google-logo.png"
    > {{ lang.google_account }}
  </a>
</template>

<script>

export default {
  props: {
    setLang: {
      type: Object,
      default: undefined
    }
  },
  computed: {
    lang () {
      return this.$store.state.lang
    }
  },
  mounted () {
    if (this.set_lang !== undefined) { this.$store.commit('set_lang', this.set_lang) }
  }
}
</script>
