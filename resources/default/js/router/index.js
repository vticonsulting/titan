import Vue from 'vue'
import Router from 'vue-router'
// import store from '../store'
// import routes from './routes'

import Home from '../views/Home'
import Dashboard from '../views/Dashboard'
import RegisterUser from '../views/RegisterUser'

Vue.use(Router)

const router = new Router({
  // mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    // {
    //   path: '/',
    //   redirect: '/dashboard'
    // },
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: Dashboard
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterUser
    }
  // ].concat(routes)
  ]
})

// router.beforeEach((to, from, next) => {
//   const authenticated = store.state.user.authenticated
//   const onlyLoggedOut = to.matched.some(record => record.meta.onlyLoggedOut)
//   const isPublic = to.matched.some(record => record.meta.public)
//   if (!isPublic && !authenticated) {
//     // this route requires auth, check if logged in
//     // if not, redirect to login page.
//     return next({
//       path: '/login',
//       query: { redirect: to.fullPath }
//     })
//   }
//   if (authenticated && onlyLoggedOut) {
//     return next('/')
//   }
//   next()
// })

export default router
