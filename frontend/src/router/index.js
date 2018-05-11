import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import Login from '@/components/Login'
import MyApp from '@/components/MyApp'
import CredentialsService from '@/services/Credentials.service'

let credentials = new CredentialsService()

Vue.use(Router)

const router = new Router({
  routes: [
    {
      name: 'MyApp',
      path: '/',
      component: MyApp,
      children: [
        {
          path: '/',
          component: HelloWorld
        }
      ]
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    }
  ]
})

router.beforeEach((to, from, next) => {
  if (credentials.isLogin()) {
    if (to.path === '/login') next({path: '/'})
    else next()
  } else {
    if (to.path === '/login') next()
    else next({path: '/login'})
  }
})

export default router
