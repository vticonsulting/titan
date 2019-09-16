<template>
  <div class="event-info py-2 px-4 mx-auto max-w-xl">
    <div class="columns is-mobile">
      <div class="column">
        <span class="text-sm">
          Event Date
          <b>{{ eventDate }}</b>
        </span>
      </div>
      <div class="column has-text-right">
        <span class="text-sm">
          <b>{{ daysRemaining }}</b> Days Remaining
        </span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "EventInfo",
  status: "prototype",
  release: "1.0.0",
  props: {
    funrunDate: {
      type: Date,
      default: null
    }
  },
  computed: {
    eventDate() {
      return (
        this.funrunDate.getMonth() +
        1 +
        "/" +
        this.funrunDate.getDate() +
        "/" +
        this.funrunDate.getFullYear()
      );
    },
    daysRemaining() {
      return Math.floor((this.funrunDate - Date.now()) / (1000 * 60 * 60 * 24));
    }
  }
};
</script>
