import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '@/src/stores/auth.store';
import routes from './routes';

export const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const auth = useAuthStore();

  if (!to.meta.middleware) {
    return next();
  }
  const middleware = to.meta.middleware;

  const context = {
    to,
    from,
    next,
    auth,
  };
  // @ts-expect-error: ignore error middleware is array not object
  return middleware[0]({
    ...context,
  });
});
