import Vue from 'vue'
import VueRouter from 'vue-router'
import SignUp from '../views/SignUp.vue'
import Login from '../views/Login.vue'
import Home from '../views/Home.vue'
import Room from '../views/Room.vue'
import CreateNewMovie from '../views/CreateNewMovie.vue'
import EditMovie from '../views/EditMovie.vue'
Vue.use(VueRouter)

const routes = [
  {
    path: '/signup',
    name: 'SignUp',
    component: SignUp
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/room',
    name: 'Room',
    component: Room
  },
  {
    path: '/create_new_movie',
    name: 'CreateNewMovie',
    component: CreateNewMovie
  },
  {
    path: '/edit_movie',
    name: 'EditMovie',
    component: EditMovie
  },
  
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
