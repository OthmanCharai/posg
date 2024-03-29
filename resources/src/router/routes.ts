import type { NavigationGuardNext, RouteLocationNormalized } from 'vue-router';
import { store } from '@store/index';

const AuthenticatedLayout = () => import('@/src/layouts/Authenticated.vue');
const GuestLayout = () => import('@/src/layouts/Guest.vue');

function isAuthenticated(to: RouteLocationNormalized, from: RouteLocationNormalized, next: NavigationGuardNext) {
  const authStore = store.auth();
  let isLogin = false;
  isLogin = !!authStore.authenticated; // we need to get a cookie value

  if (isLogin) {
    next();
  } else {
    next({ name: 'sign-in' });
  }
}

export default [
  {
    path: '/',
    redirect: {
      name: 'sign-in'
    },
    component: GuestLayout,
    beforeEnter: isAuthenticated,
    children: [
      {
        path: '',
        name: 'sign-in',
        component: () => import('@pages/auth/SignIn.vue'),
      },
      // {
      //     path: 'register',
      //     name: 'auth.register',
      //     component: ,
      //     beforeEnter: guest,
      // },
      // {
      //     path: 'forgot-password',
      //     name: 'auth.forgot-password',
      //     component: ,
      //     beforeEnter: guest,
      // },
      // {
      //     path: 'reset-password',
      //     name: 'auth.reset-password',
      //     component: ,
      //     beforeEnter: guest,
      // },
    ]
  },
  {
    path: '/admins',
    redirect: {
      name: 'admins'
    },
    component: AuthenticatedLayout,
    beforeEnter: isAuthenticated,
    children: [
      {
        path:"",
        name: 'admins',
        component: () => import('@pages/admins/App.vue')
      },
    ]
  },
  // {
  //     path: "/:pathMatch(.*)*",
  //     name: 'NotFound',
  //     component: () => import("errors/404.vue"),
  // },
];
