<template>
  <section class="rewards-carousel">
    <article :class="[ show ? 'block' : 'hidden']">
      <h1 class="is-size-4 has-text-weight-bold">
        Rewards
      </h1>
      <h2 class="mb-4">
        $30 flat donation = $1 per lap
      </h2>
      <!-- TODO Fix initial load display glitch (slick) Convert to CSS Grid instead of flexbox?-->
      <!-- TODO Make pagination dots bigger (slick) -->
      <!-- TODO Add and style previous / next chevrons (slick) -->
      <Slick
        ref="slick"
        :options="slickOptions"
        @afterChange="handleAfterChange"
        @beforeChange="handleBeforeChange"
        @breakpoint="handleBreakpoint"
        @destroy="handleDestroy"
        @edge="handleEdge"
        @init="handleInit"
        @reInit="handleReInit"
        @setPosition="handleSetPosition"
        @swipe="handleSwipe"
        @lazyLoaded="handleLazyLoaded"
        @lazyLoadError="handleLazeLoadError"
      >
        <button
          v-for="(card, index) in cards"
          :key="index"
          class="card-container p-2"
          @click.prevent="showRewardVideo"
        >
          <div class="card">
            <div class="card-image">
              <figure class="image is-4by3">
                <img
                  src="/assets/dashboard/images/placeholders/640x360.png"
                  alt="Mindspark Gears"
                >
                <div class="position-1">
                  <div class="has-background-secondary has-text-white rounded-r-full p-2 pr-6 font-semibold">
                    Received it
                  </div>
                </div>
                <div class="position-2">
                  <div class="overlay-text">
                    <FontAwesomeIcon
                      icon="play-circle"
                      size="2x"
                    />
                  </div>
                </div>
              </figure>
            </div>
            <div class="card-content bg-grey-lightest">
              <div class="has-text-centered">
                <h2 class="is-size-7">
                  $1 Per Reading Challenge
                </h2>
                <h3 class="has-text-weight-bold is-size-6">
                  Mindspark Gears (10)
                </h3>
              </div>
            </div>
          </div>
        </button>
      </Slick>
    </article>
    <div class="has-text-centered lg:border-b lg:pb-1">
      <button
        class="button is-white has-text-weight-bold"
        @click="toggleRewards"
      >
        <span>{{ show ? 'Close' : 'View' }} Rewards</span>
        <FontAwesomeIcon
          :icon="show ? 'caret-up' : 'caret-down'"
          fixed-width
        />
      </button>
    </div>
  </section>
</template>
<script>
import Slick from 'vue-slick'

export default {
  name: 'RewardsCarousel',
  status: 'prototype',
  release: '1.0.0',
  components: {
    Slick
  },
  data () {
    return {
      show: false,
      cards: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
      slickOptions: {
        slidesToShow: 1,
        // Any other options that can be got from plugin documentation
        dots: true,
        // dotsClass: 'slider-nav-dots',
        rows: 2,
        slidesPerRow: 2,
        prevArrow: `<button type="button is-primary" class="slick-prev">Previous</button>`,
        nextArrow: `<button type="button" class="slick-next">Next</button>`,
        autoplay: false,
        arrows: true,
        mobileFirst: true,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              arrows: true,
              centerMode: false,
              centerPadding: '40px',
              slidesToShow: 1,
              rows: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              arrows: true,
              centerMode: false,
              centerPadding: '40px',
              slidesToShow: 1
            }
          }
        ]
      }
    }
  },
  methods: {
    toggleRewards () {
      this.show = !this.show
      setTimeout(() => {
        // Firing setPosition once has an error calculating carousel width on window size < 575px. Width is corrected after firing a second time.
        $('.slick-slider')
          .slick('setPosition')
          .slick('setPosition')
      }, 0)
    },
    showRewardVideo () {
      this.$modal.open(
        `<figure class="image is-16by9 mb-4">
                    <iframe src="https://player.vimeo.com/video/16535263"
                    style="position:absolute;top:0;left:0;width:100%;height:100%;"
                    frameborder="0"
                    webkitallowfullscreen
                    mozallowfullscreen
                    allowfullscreen
                    />
                </figure>`
      )
    },
    next () {
      this.$refs.slick.next()
    },

    prev () {
      this.$refs.slick.prev()
    },

    reInit () {
      // Helpful if you have to deal with v-for to update dynamic lists
      this.$nextTick(() => {
        this.$refs.slick.reSlick()
      })
    },

    // Events listeners
    handleAfterChange (event, slick, currentSlide) {
      console.log('handleAfterChange', event, slick, currentSlide)
    },
    handleBeforeChange (event, slick, currentSlide, nextSlide) {
      console.log('handleBeforeChange', event, slick, currentSlide, nextSlide)
    },
    handleBreakpoint (event, slick, breakpoint) {
      console.log('handleBreakpoint', event, slick, breakpoint)
    },
    handleDestroy (event, slick) {
      console.log('handleDestroy', event, slick)
    },
    handleEdge (event, slick, direction) {
      console.log('handleEdge', event, slick, direction)
    },
    handleInit (event, slick) {
      console.log('handleInit', event, slick)
    },
    handleReInit (event, slick) {
      console.log('handleReInit', event, slick)
    },
    handleSetPosition (event, slick) {
      console.log('handleSetPosition', event, slick)
    },
    handleSwipe (event, slick, direction) {
      console.log('handleSwipe', event, slick, direction)
    },
    handleLazyLoaded (event, slick, image, imageSource) {
      console.log('handleLazyLoaded', event, slick, image, imageSource)
    },
    handleLazeLoadError (event, slick, image, imageSource) {
      console.log('handleLazeLoadError', event, slick, image, imageSource)
    }
  }
}
</script>

<style lang="scss">
.card-container:focus {
  outline: none;
}

.slick-dots li button {
  &:before {
    font-size: 1rem;
  }
}

.slick-prev.slick-disabled:before,
.slick-next.slick-disabled:before {
  opacity: initial;
}

.slick-next {
  right: -18px;
}
.slick-prev {
  left: -18px;
}

.slick-prev:before,
.slick-next:before {
  font-size: 20px;
  line-height: 1;
  opacity: 0.75;
  color: black;
  padding: 13rem 0;
}

.image {
  position: relative;
}

img {
  display: block;
  width: 100%;
  height: auto;
  &.is-variant {
    opacity: 1;
    transition: 0.5s ease;
    backface-visibility: hidden;
  }
}

.position-1 {
  transition: 0.5s ease;
  position: absolute;
  top: 1rem;
  left: 0;
  text-align: center;
}
.position-2 {
  transition: 0.5s ease;
  position: absolute;
  bottom: 1rem;
  right: 1rem;
  text-align: center;
}
.position-3 {
  width: 50%;
  margin: auto;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}
</style>
