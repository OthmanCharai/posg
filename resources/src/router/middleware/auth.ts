import type { NavigationGuardNext } from 'vue-router';
import { useAuthStore } from '@stores/auth';

interface GuestFunctionParams {
  next: NavigationGuardNext;
  auth: ReturnType<typeof useAuthStore>;
}

export default function guest ({ next, auth }: GuestFunctionParams){
  if(!auth.isLogin.loggedIn){
      return next({
        name: 'Login'
      })
  }

  return next()
}
