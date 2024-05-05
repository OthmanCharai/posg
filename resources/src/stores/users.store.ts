import { defineStore } from 'pinia';
import { useAxios, route } from '@utils/axios-helper';
import { extractPaginatorObject } from '@utils/pagination';
import type { PaginationMetadata } from '@common/types/global/pagination';
import { Users } from '@common/types/users';
import { Roles } from '@common/types/global/roles';
import { Toast } from '@utils/toast';

const { request, response, loading } = useAxios();

export const useUserStore = defineStore('users', {
  state: () => ({
    usersData: [] as Users[],
    roles: [] as Roles[],
    pagination: {} as PaginationMetadata,
    loading: loading,
    getResponse: false,
    selectedUser: {} as Users,
  }),

  actions: {
    async getUsersList(page: number = 1) {
      await request({
        method: 'GET',
        url: route('users.index', `page=${page}`),
      });
      if (response.value && response.value.data) {
        this.usersData = response.value.data.users.data;
        this.roles = response.value.data.roles;
        this.pagination = extractPaginatorObject(response.value.data.users);
        this.getResponse = true;
      }
    },

    async createUser(formData: FormData, showCreateModal: Ref<boolean>) {
      await request({
        method: 'POST',
        url: route('users.create.submit'),
        data: formData,
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });

      if (response.value && response.value.data) {
        Toast.success('Votre compte a été crée avec succès.');
        showCreateModal.value = false;
        await this.getUsersList(this.pagination.current_page);
      }
    },

    async updateUser(formData: FormData, showUpdateModal: Ref<boolean>) {
      await request({
        method: 'POST',
        url: route('users.update', this.selectedUser.id),
        data: formData,
        headers: {
          'Content-Type': 'multipart/form-data',
        },
        params: {
          _method: 'PUT',
        },
      });

      if (response.value && response.value.data) {
        Toast.success('Votre compte a été mis à jour avec succès.');
        showUpdateModal.value = false;
        await this.getUsersList(this.pagination.current_page);
      }
    },

    setSelectedUserData(data: Users) {
      this.selectedUser = data;
    },
  },
});
