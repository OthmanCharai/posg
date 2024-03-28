import {createRouter, createWebHistory} from 'vue-router';
import SignIn from '@pages/auth/SignIn.vue';
import Admin from "@pages/admins/App.vue"

const routes = [
  {
    path: '/',
    name: 'sign-in',
    component: SignIn
  },
  {
    path:"/admins",
    name: 'admins',
    component: Admin
  }
];

export const router = createRouter({
  history: createWebHistory('/'),
    linkActiveClass: 'active',
    routes,
});

router.beforeEach((to, from, next) => {
// Scroll to the top of the page
window.scrollTo({ top: 0, behavior: 'smooth' });
// Continue with the navigation
next();
});
