import Vue from 'vue';
import lodash from 'lodash';
import axios from 'axios';

import './plugins';
import './components';
import './utilities';

try {
  window.$ = window.jQuery = require('jquery');
} catch (e) { }

window._ = lodash;
window.Vue = Vue;
window.axios = axios;
window.axios.defaults.headers.common = {
  'X-Requested-With': 'XMLHttpRequest'
};

// let token = document.head.querySelector('meta[name="csrf-token"]');
// if (token) {
//   window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
// } else {
//   console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
// }
