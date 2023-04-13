import Vue from 'vue'
import VueRouter, { RouteConfig } from 'vue-router'
import HomeView from '@/views/Home.vue'
import LayoutDefault from '@/layouts/LayoutDefault.vue'

Vue.use(VueRouter)

const routes: Array<RouteConfig> = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
    meta: {
      layout: LayoutDefault,
      title: 'Home Page'
    }
  },
  {
    path: '/favorite',
    name: 'favorite',
    component: () => import('@/views/Favorite.vue'),
    meta: {
      layout: LayoutDefault,
      title: 'Favorite'
    }
  },
  {
    path: '*',
    name: 'page-not-found',
    component: () => import('@/views/PageNotFound.vue'),
    meta: {
      layout: LayoutDefault,
      title: 'Page Not Found'
    }
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
  scrollBehavior (to: any, from: any, savedPosition: any) {
    // savedPosition is only available for popstate navigations.
    if (savedPosition) return savedPosition

    // prevent scroll when router change in same page
    if (to.name === from.name) return {}

    // scroll to anchor by returning the selector
    if (to.hash) {
      const position = { selector: to.hash }
      return position
    }

    // scroll to top by default
    return { x: 0, y: 0 }
  }
})

router.afterEach((to: any, from: any) => {
  document.title = to.meta.title
})

export default router
