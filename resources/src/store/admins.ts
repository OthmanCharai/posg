import { defineStore } from 'pinia'
import IAdmin from '../pages/admins/type'
import { useAxios, route } from '../utils/axios-helper'

const { request, response } = useAxios();

export const admins = defineStore('admins', {
  state: () => ({
    admins: {} as IAdmin,
  }),

  actions: {
    getAdminData(data: IAdmin) {
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
