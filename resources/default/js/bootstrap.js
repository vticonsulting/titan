import Vue from 'vue'
import lodash from 'lodash'
import axios from 'axios'

import './plugins'
// import './components'
// import './utilities'

try {
  window.$ = window.jQuery = require('jquery')
} catch (e) { }

window._ = lodash
window.Vue = Vue
window.Events = new Vue()
window.axios = axios
window.axios.defaults.headers.common = {
  'X-Requested-With': 'XMLHttpRequest'
}

Promise.delay = function (time) {
  return new Promise((resolve, reject) => {
    setTimeout(resolve, time)
  })
}

// Promise.prototype.takeAtLeast = function (time) {
//   return new Promise((resolve, reject) => {
//     Promise.all([this, Promise.delay(time)]).then(([result]) => {
//       resolve(result)
//     }, reject)
//   })
// }
