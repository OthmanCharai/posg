import { defineStore } from 'pinia';
import { useAxios, route } from '@utils/axios-helper';
import { extractPaginatorObject } from '@utils/pagination';
import type { PaginationMetadata } from '@common/types/global/pagination';

const { request, response } = useAxios();

export const useUsers = defineStore('users', {
  state: () => ({
    usersData: [],
    roles: [],
    pagination: {} as PaginationMetadata,
    loading: false,
  }),

  actions: {
    async getUsersList (page: number = 1) {
      this.loading = true;
      await request({
        method: 'GET',
        url: route('users.index', `page=${page}`)
      })
      try {
        if (response.value && response.value.data) {
          this.usersData = response.value.data.users.data;
          this.roles = response.value.data.roles;
          this.pagination = extractPaginatorObject(response.value.data.users);
        }
      } catch(e) {
        console.error(e)
      } finally {
        this.loading = false
      }
    }
  }
})
