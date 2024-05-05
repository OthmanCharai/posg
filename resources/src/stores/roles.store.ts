import { defineStore } from 'pinia';
import type { Permissions, Roles } from '@common/types/global/roles';
import type { PaginationMetadata } from '@common/types/global/pagination';
import { route, useAxios } from '@utils/axios-helper';
import { extractPaginatorObject } from '@utils/pagination';
import { Toast } from '@utils/toast';

const { request, response, loading } = useAxios();

export const useRoleStore = defineStore('roles', {
  state: () => ({
    roles: [] as Roles[],
    pagination: {} as PaginationMetadata,
    loading: loading,
    getResponse: false,
    currentRole: {} as Roles,
    permissions: [] as Permissions[],
  }),
  actions: {
    async getRolesList(page: number = 1) {
      await request({
        method: 'GET',
        url: route('roles.index', `page=${page}`),
      });
      try {
        if (response.value && response.value.data) {
          this.roles = response.value.data.admin_roles.data;
          this.pagination = extractPaginatorObject(response.value.data.admin_roles);
          this.getResponse = true;
          let result = [];

          this.permissions = response.value.data.permissions;
          for (const [category, perms] of Object.entries(this.permissions)) {
            for (const [key, value] of Object.entries(perms)) {
              result.push({
                label: value,
                value: key,
              });
            }
          }
          this.permissions = result;
        }
      } catch (e) {
        console.error(e);
      }
    },

    async createRole(data: Roles, showCreateModal: Ref<boolean>) {
      await request({
        method: 'POST',
        url: route('roles.create'),
        data: data,
      });
      try {
        if (response.value) {
          Toast.success('Votre role a été ajouter avec succès.');
          showCreateModal.value = false;
          await this.getRolesList();
        }
      } catch (e) {
        console.error(e);
      }
    },

    async updateRole(data: Roles, showUpdateModal: Ref<boolean>) {
      await request({
        method: 'PUT',
        url: route('roles.update', this.currentRole.id),
        data: data,
      });
      try {
        if (response.value) {
          Toast.success('Votre role a été modifié avec succès.');
          showUpdateModal.value = false;
          await this.getRolesList();
        }
      } catch (e) {
        console.error(e);
      }
    },

    setCurrentRoleData(data: Roles) {
      this.currentRole = data;
    },
  },
});
