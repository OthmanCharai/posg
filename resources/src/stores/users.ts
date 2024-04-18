import { defineStore } from 'pinia';
import { useAxios, route } from '@utils/axios-helper';
import { extractPaginatorObject } from '@utils/pagination';
import type { PaginationMetadata } from '@common/types/global/pagination';
import { Users } from '@common/types/users';
import { Roles } from '@common/types/global/roles';

const { request, response, loading } = useAxios();

export const useUserStore = defineStore('users', {
  state: () => ({
    usersData: [] as Users[],
    roles: [] as  Roles[],
    pagination: {} as PaginationMetadata,
    loading: loading,
    getResponse: false,
    currentUser: {} as Users,
  }),

  actions: {
    async getUsersList (page: number = 1) {
      await request({
        method: 'GET',
        url: route('users.index', `page=${page}`)
      })
      try {
        if (response.value && response.value.data) {
          this.usersData = response.value.data.users.data;
          this.roles = response.value.data.roles;
          this.pagination = extractPaginatorObject(response.value.data.users);
          this.getResponse = true;
        }
      } catch(e) {
        console.error(e)
      }
    },
    setCurrentUserData(data: Users) {
      this.currentUser = data;
    },
    addNewUser(user: Users) {
      this.usersData.push(user);
    },
    deleteUser (userId: string | undefined) {
      if(!userId) {
        return;
      }
      const index = this.usersData.findIndex(user => user.id === userId);

      if(index !== -1) {
        this.usersData.splice(index, 1);
      }
    }
  }
})
