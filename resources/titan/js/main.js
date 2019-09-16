import Vue from 'vue'
import router from './router'
import store from './store'
// import loader from './views/Loader';

import { mapState } from 'vuex'
Vue.use(mapState)
// Vue.component('vuex-loader', loader);

require('./bootstrap')

// eslint-disable-next-line
const app = new Vue({
  el: '#app',
  store,
  router,
  data () {
    return {
      show: false,
      user: require('./data/user2.json'),
      s3_bucket: '',
      avatar_path: '',
      lang: {}
    }
  },
  created () {
    this.$store.commit('SET_USER', this.user)
    this.$store.commit('setS3Bucket', this.s3_bucket)
    this.$store.commit('setAvatarPath', this.avatar_path)
    // lang = json_encode(array_merge(Lang:: get('parentDashboard')))
    // this.$store.commit('SET_LANG', this.lang);
  }
})
