import type { NavigationGuardNext } from 'vue-router';
import type { useAuthStore } from '@/src/stores/auth.store';

interface GuestFunctionParams {
  next: NavigationGuardNext;
  auth: ReturnType<typeof useAuthStore>;
}

export default async function guest({ next, auth }: GuestFunctionParams) {
  await auth.getUser();

  if (auth.authenticated) {
    return next({
      name: 'Dashboard',
    });
  }

  return next();
}
