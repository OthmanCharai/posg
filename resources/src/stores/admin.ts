import { defineStore } from 'pinia'
import type { Admin } from '@common/types/global/admin';
import { useAxios, route } from '../utils/axios-helper';

const { request, response } = useAxios();

export const useAdminStore = defineStore('admin', {
  state: () => ({
    admins: {} as Admin,
  }),

  actions: {
    getAdminData(data: Admin) {
      request({
        method: 'GET',
        url: route('admins.index')
      });

      if (response.value) {
        this.admins = data;
      }
    }
  }
})
