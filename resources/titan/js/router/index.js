import Vue from 'vue'
import VueRouter from 'vue-router'
import AppContainer from '../layouts/AppContainer'
import NProgress from 'nprogress'

import ParentDashboard from '../views/ParentDashboard'
import TeacherDashboard from '../views/TeacherDashboard'
import EditParticipant from '../views/EditParticipant'
import EditProfile from '../views/EditProfile'
import EasyEmailer from '../views/EasyEmailer'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    component: AppContainer,
    children: [
      {
        path: '',
        name: 'parent-dashboard',
        component: ParentDashboard
      },
      {
        path: '/teacher-dashboard',
        name: 'teacher-dashboard',
        component: TeacherDashboard
      },
      {
        path: '/edit-participant',
        name: 'edit-participant',
        component: EditParticipant,
        meta: {
          title: 'Edit Student'
        }
      },
      {
        path: '/edit-profile',
        name: 'edit-profile',
        component: EditProfile,
        meta: {
          title: 'Edit Your Profile'
        }
      },
      {
        path: '/easy-emailer',
        name: 'easy-emailer',
        component: EasyEmailer
      }
    ]
  }

]

const router = new VueRouter({
  // mode: 'history',
  linkActiveClass: 'is-active',
  routes,

  scrollBehavior (to, from, savedPosition) {
    return { x: 0, y: 0 }
  }
})

router.beforeEach((routeTo, routeFrom, next) => {
  NProgress.start()
  next()
})

router.afterEach(() => {
  NProgress.done()
})

export default router
