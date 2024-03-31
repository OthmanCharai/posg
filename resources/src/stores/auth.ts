import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: {
      loggedIn: false
    }
  }),

  getters: {
    isLogin(state) {
      return state.user;
    }
  }
})
