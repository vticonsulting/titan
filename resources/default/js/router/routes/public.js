import Login from '@/views/Login.vue'
import Registration from '@/views/Registration.vue'
import ForgotPassword from '@/views/ForgotPassword.vue'

const routes = [
  {
    path: '/login',
    name: 'login',
    component: Login
  },
  {
    path: '/registration',
    name: 'registration',
    component: Registration
  },
  {
    path: '/forgot-password',
    name: 'forgotPassword',
    component: ForgotPassword
  }
]

export default routes.map(route => {
  const meta = {
    public: true,
    onlyLoggedOut: true
  }
  return { ...route, meta }
})
