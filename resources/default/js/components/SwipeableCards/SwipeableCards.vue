<template>
  <div class="swipeable-cards">
    <GameCardsStack
      :cards="visibleCards"
      @cardAccepted="handleCardAccepted"
      @cardRejected="handleCardRejected"
      @cardSkipped="handleCardSkipped"
      @hideCard="removeCardFromDeck"
    />
  </div>
</template>

<script>
import GameCardsStack from "./GameCardsStack";

export default {
  name: "App",
  components: {
    GameCardsStack
  },

  data() {
    return {
      visibleCards: ["Test", "Vue.js", "Webpack"]
    };
  },

  methods: {
    handleCardAccepted() {
      console.log("handleCardAccepted");
    },
    handleCardRejected() {
      console.log("handleCardRejected");
    },
    handleCardSkipped() {
      console.log("handleCardSkipped");
    },
    removeCardFromDeck() {
      this.visibleCards.shift();
    }
  }
};
</script>

<style lang="scss">
@import "../../../styles/mixins.scss";

#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  text-align: center;
}
</style>
