import { defineStore } from 'pinia'

export const auth = defineStore('auth', {
  state: () => ({
    authenticated: false,
  }),

  actions: {
    isLogin(data: boolean) {
      this.authenticated = data;
    },
  }
})
