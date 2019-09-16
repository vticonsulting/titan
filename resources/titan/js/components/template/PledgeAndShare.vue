<template>
  <section
    class="pledge-and-share px-6 lg:px-0 mb-8 lg:m-8 max-w-xl mx-auto"
    style="background-color: #fff"
  >
    <div class="has-text-centered my-4">
      <button
        v-if="showAskPreviousSponsors"
        class="button is-medium is-secondary is-rounded is-fullwidth mb-4"
      >Ask Previous Sponsors</button>
      <button
        v-if="showPayPledgesOnline"
        class="button is-medium is-secondary is-outlined is-rounded is-fullwidth"
      >Pay Pledges Online</button>
    </div>

    <ShareButtons :participants="participants"/>
  </section>
</template>

<script>
import ShareButtons from "../pattern/ShareButtons";

export default {
  name: "PledgeAndShare",
  status: "prototype",
  release: "1.0.0",
  components: {
    ShareButtons
  },
  props: {
    showAskPreviousSponsors: {
      type: Boolean,
      default: false
    },
    showPayPledgesOnline: {
      type: Boolean,
      default: false
    },
    participants: {
      type: Array,
      default: () => []
    }
  }
};
</script>
