<template>
  <div
    id="app"
    class="container"
  >
    <app-nav />
    <router-view class="page" />
    <div class="row">
      <div class="col-xs-12 col-sm-8 co-sm-offset-2 col-md-6 col-md-offset-3">
        <portal to="modals">
          <p>
            This slot content will be rendered wherever the
            portal target with name 'destination'
            is located.
          </p>
        </portal>
        <h1>Animations</h1>
        <hr>
        <select
          v-model="alertAnimation"
          class="form-control"
        >
          <option value="fade">
            Fade
          </option>
          <option value="slide">
            Slide
          </option>
        </select>
        <br>
        <br>
        <button
          class="btn btn-primary px-4 py-2"
          @click="show = !show"
        >
          Show Alert
        </button>
        <br>
        <br>
        <transition :name="alertAnimation">
          <div
            v-if="show"
            class="alert alert-info"
          >
            This is some Info
          </div>
        </transition>

        <transition
          name="slide"
          type="animation"
          appear
        >
          <div
            v-if="show"
            class="alert alert-info"
          >
            This is some Info
          </div>
        </transition>

        <transition
          enter-class
          enter-active-class="animated bounce"
          leave-class
          leave-active-class="animated shake"
        >
          <div
            v-if="show"
            class="alert alert-info"
          >
            This is some Info
          </div>
        </transition>

        <transition
          :name="alertAnimation"
          mode="out-in"
        >
          <div
            v-if="show"
            key="info"
            class="alert alert-info"
          >
            This is some info
          </div>
          <div
            v-else
            key="warning"
            class="alert alert-warning"
          >
            This is some warning
          </div>
        </transition>
        <hr>
        <button
          class="btn btn-primary"
          @click="load = !load"
        >
          Load / Remove Element
        </button>
        <br>
        <br>
        <transition
          :css="false"
          @before-enter="beforeEnter"
          @enter="enter"
          @after-enter="afterEnter"
          @enter-cancelled="enterCancelled"
          @before-leave="beforeLeave"
          @leave="leave"
          @after-leave="afterLeave"
          @leave-cancelled="leaveCancelled"
        >
          <div
            v-if="load"
            style="width: 300px; height: 100px; background-color: lightgreen"
          />
        </transition>
        <hr>
        <button
          class="btn btn-primary"
          @click="selectedComponent == 'app-success-alert' ? selectedComponent = 'app-danger-alert' : selectedComponent = 'app-success-alert'"
        >
          Toogle Components
        </button>
        <br>
        <br>
        <transition
          name="fade"
          mode="out-in"
        >
          <component :is="selectedComponent" />
        </transition>
        <hr>
        <button
          class="btn btn-primary"
          @click="addItem"
        >
          Add Item
        </button>
        <br>
        <br>
        <ul class="list-group">
          <transition-group name="slide">
            <li
              v-for="(number, index) in numbers"
              :key="number"
              class="list-group-item"
              style="cursor: pointer"
              @click="removeItem(index)"
            >
              {{ number }}
            </li>
          </transition-group>
        </ul>
      </div>
    </div>
    <portal-target name="modals">
      <!--
  This component can be located anwhere in your App
  (i.e. right before the </body> tag, for good for overlays).
  The slot content of the above portal component will be rendered here.
      -->
    </portal-target>
  </div>
</template>

<script>

import AppNav from './components/AppNav/AppNav'
import DangerAlert from './components/DangerAlert/DangerAlert'
import SuccessAlert from './components/SuccessAlert/SuccessAlert'

export default {
  components: {
    AppNav,
    appDangerAlert: DangerAlert,
    appSuccessAlert: SuccessAlert
  },
  data () {
    return {
      show: false,
      load: false,
      alertAnimation: 'fade',
      elementWidth: 100,
      selectedComponent: 'app-success-alert',
      numbers: [1, 2, 3, 4, 5]
    }
  },
  methods: {
    beforeEnter (el) {
      console.log('beforeEnter')
      this.elementWidth = 100
      el.style.width = this.elementWidth + 'px'
    },
    enter (el, done) {
      console.log('enter')

      let round = 1
      const interval = setInterval(() => {
        el.style.width = this.elementWidth + round * 10 + 'px'
        round++
        if (round > 20) {
          clearInterval(interval)
          done()
        }
      }, 20)
    },
    afterEnter (el) {
      console.log('afterEnter')
    },
    enterCancelled (el) {
      console.log('enterCancelled')
    },
    beforeLeave (el) {
      console.log('beforeLeave')
      this.elementWidth = 300
      el.style.width = this.elementWidth + 'px'
    },
    leave (el, done) {
      console.log('leave')

      let round = 1
      const interval = setInterval(() => {
        el.style.width = this.elementWidth - round * 10 + 'px'
        round++
        if (round > 20) {
          clearInterval(interval)
          done()
        }
      }, 20)
    },
    afterLeave (el) {
      console.log('afterLeave')
    },
    leaveCancelled (el) {
      console.log('leaveCancelled')
    },
    addItem () {
      const pos = Math.floor(Math.random() * this.numbers.length)
      this.numbers.splice(pos, 0, Math.max(...this.numbers) + 1)
    },
    removeItem (index) {
      this.numbers.splice(index, 1)
    }
  }
}
</script>

<style lang="scss">
@import '../styles/global.scss';

.page {
  display: flex;
  justify-content: center;
  flex-direction: column;
  align-items: center;
  min-height: calc(100vh - 56px);
}
.fade-enter {
  opacity: 0;
}

.fade-enter-active {
  transition: opacity 1s;
  /* no need to set opacity: 1; here */
}

.fade-leave {
  /* opacity: 1; */
}

.fade-leave-active {
  transition: opacity 1s;
  opacity: 0;
}

.slide-enter {
  opacity: 0;
  /* transform: translateY(20px); */
}
.slide-enter-active {
  animation: slide-in 1s ease-out forwards;
  transition: opacity 0.5s;
}
.slide-leave {
}
.slide-leave-active {
  animation: slide-out 1s ease-out forwards;
  transition: opacity 1s;
  opacity: 0;
  position: absolute;
}
.slide-move {
  transition: transform 1s;
}

@keyframes slide-in {
  from {
    transform: translateY(20px);
  }

  to {
    transform: translateY(0);
  }
}

@keyframes slide-out {
  from {
    transform: translateY(0);
  }

  to {
    transform: translateY(20px);
  }
}
</style>
