window.Vue = require('vue');

import VueRouter from 'vue-router';
import store from './store';
Vue.use(VueRouter);

import HomeComponent from './components/HomeComponent.vue';
import CreateComponent from './components/CreateComponent.vue';
import IndexComponent from './components/IndexComponent.vue';
import EditComponent from './components/EditComponent.vue';
import Login from './components/Login.vue';
import Register from './components/Register.vue';


const routes = [
    {
        name: 'login',
        path: '/vuelaravelcrud/login',
        component: Login
    },
    {
        name: 'register',
        path: '/vuelaravelcrud/register',
        component: Register
    },
    {
      name: 'home',
      path: '/vuelaravelcrud',
      component: HomeComponent,
      meta: { 
        requiresAuth: true
      }
  },
  {
      name: 'create',
      path: '/vuelaravelcrud/create',
      component: CreateComponent,
      meta: { 
        requiresAuth: true
      }
  },
  {
      name: 'posts',
      path: '/vuelaravelcrud/posts',
      component: IndexComponent,
      meta: { 
        requiresAuth: true
      }
  },
  {
      name: 'edit',
      path: '/vuelaravelcrud/edit/:id',
      component: EditComponent,
      meta: { 
        requiresAuth: true
      }
  }
];

const router = new VueRouter({ mode: 'history', routes: routes });
router.beforeResolve((to, from, next) => {
    // If this isn't an initial page load.
    if (to.name) {
        // Start the route progress bar.
        NProgress.start()
    }
    next()
  })
  
  router.afterEach((to, from) => {
    // Complete the animation of the route progress bar.
    NProgress.done()
  })
  router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
      if (store.getters.isLoggedIn) {
        next()
        return
      }
      next('/vuelaravelcrud/login') 
    } else {
      next() 
    }
  })
  export default router