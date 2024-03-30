import type { NavigationGuardNext, RouteLocationNormalized } from 'vue-router';
import { store } from '@stores/index';

function isAuthenticated(to: RouteLocationNormalized, from: RouteLocationNormalized, next: NavigationGuardNext) {
  const authStore = store.auth();
  let isLogin = false;
  isLogin = !!authStore.authenticated;

  // check if the user is trying to access a login page
  if (to.name === 'Login' && !isLogin) {
    // allow to proceed to login page if not logged in
    next();
  } else if (isLogin) {
    // If logged in, proceed as normal
    next();
  } else {
    // redirect to login if trying to access a protected route and not logged in
    next({ name: 'Login' });
  }
}

export default [
  // -------- Guest user ---------- //
  {
    path: '/',
    redirect: {
      name: 'Login'
    },
    component: () => import('@/src/layouts/Guest.vue'),
    beforeEnter: isAuthenticated,
    children: [
      {
        path: '',
        name: 'Login',
        component: () => import('@pages/auth/Login.vue'),
      },
      // {
      //     path: 'register',
      //     name: 'Register',
      //     component: ,
      // },
      // {
      //     path: 'forgot-password',
      //     name: 'ForgotPassword',
      //     component: ,
      // },
      // {
      //     path: 'reset-password',
      //     name: 'ResetPassword',
      //     component: ,
      // },
    ]
  },

  // --------  Admin user --------- //
  {
    path: '/admins',
    component: () => import('@/src/layouts/Authenticated.vue'),
    beforeEnter: isAuthenticated,
    children: [
      {
        path:"dashboard",
        name: 'Dashboard',
        component: () => import('@pages/admin/Dashboard.vue')
      },
    ]
  },

  // --------  404 page --------- //
  // {
  //     path: "/:pathMatch(.*)*",
  //     name: 'NotFound',
  //     component: () => import("errors/404.vue"),
  // },
];
