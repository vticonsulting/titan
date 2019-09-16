import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store'

Vue.config.productionTip = false

require('./bootstrap')

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
