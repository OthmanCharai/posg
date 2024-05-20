import { defineStore } from 'pinia';
import { useAxios, route } from '@utils/axios-helper';
import { deepClone } from '@utils/object';

const { request, response } = useAxios();

export const useAuthStore = defineStore('auth', {
  state: () => ({
    authenticated: false,
    user: {},
  }),

  actions: {
    async getUser() {
      if (this.authenticated === false) {
        await request({
          method: 'GET',
          url: route('auth.me'),
        });

        if(response.value && response.value.data) {
          this.authenticated = true;
          this.user = deepClone(response.value.data);
        }
      }
    },
  },
});
