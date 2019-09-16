<template>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <h1 class="text-center">The Super Quiz</h1>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <transition name="flip" mode="out-in">
          <component
            :is="mode"
            @answered="answered($event)"
            @confirmed="mode = 'super-quiz-question'"
          ></component>
        </transition>
      </div>
    </div>
  </div>
</template>

<script>
import SuperQuizQuestion from "./SuperQuizQuestion";
import SuperQuizAnswer from "./SuperQuizAnswer";

export default {
  data() {
    return {
      mode: "super-quiz-question"
    };
  },
  methods: {
    answered(isCorrect) {
      if (isCorrect) {
        this.mode = "super-quiz-answer";
      } else {
        this.mode = "super-quiz-question";
        alert("Wrong, try again!");
      }
    }
  },
  components: {
    SuperQuizQuestion,
    SuperQuizAnswer
  }
};
</script>

<style>
.flip-enter {
  /*transform: rotateY(0deg);*/
}

.flip-enter-active {
  animation: flip-in 0.5s ease-out forwards;
}

.flip-leave {
  /*transform: rotateY(0deg);*/
}

.flip-leave-active {
  animation: flip-out 0.5s ease-out forwards;
}

@keyframes flip-out {
  from {
    transform: rotateY(0deg);
  }
  to {
    transform: rotateY(90deg);
  }
}

@keyframes flip-in {
  from {
    transform: rotateY(90deg);
  }
  to {
    transform: rotateY(0deg);
  }
}
</style>
