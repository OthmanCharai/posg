import { defineStore } from 'pinia';
import type { AuditLog } from '@common/types/global/log';
import { useAxios, route } from '@utils/axios-helper';
import { extractPaginatorObject } from '@utils/pagination';
import type { PaginationMetadata } from '@common/types/global/pagination';
import { Toast } from '@utils/toast';
import type { Users } from '@common/types/users';
import type { SelectProps } from 'ant-design-vue/es/vc-select/Select';

const { request, response, loading } = useAxios();
export const useLogStore = defineStore('logs', {
  state: () => ({
    logs: [] as AuditLog[],
    pagination: {} as PaginationMetadata,
    getResponse: false,
    loading: loading,
    currentLog: {} as AuditLog,
    users: [] as SelectProps['options'],
    tables: [] as string[],
    log_types: [
      {
        'value': 'create',
        'label': 'ajouter'
      },
      {
        'value': 'update',
        'label': 'modifier'
      },
      {
        'value': 'delete',
        'label': 'supprimer'
      }
    ]
  }),

  actions: {
    async get(page: number = 1) {
      await request({
        url: '/api/logs',
        method: 'GET',
      });

      if (response.value && response.value?.data) {
        this.logs = response.value?.data.data;
        this.pagination = extractPaginatorObject(response.value?.data);
        this.getResponse = true;
      }
    },

    async create(data: any, showCreateModal: Ref<boolean>) {
      await request({
        url: route('logs.store'),
        method: 'POST',
        data: data
      });
      if (response.value) {
        Toast.success('utilisateur activite a été crée avec succès.');
        showCreateModal.value = false;
        await this.get();
      }
    },

    async update(log: AuditLog, data: any, showUpdateModal: Ref<boolean>) {
      await request({
        url: route('logs.update', log.id),
        method: 'PUT',
        data: data
      });
      if (response.value) {
        Toast.success('utilisateur activite a été modifie avec succès.');
        showUpdateModal.value = false;
        await this.get();
      }
    },
    async delete(log: AuditLog) {
      await request({
        url: route('logs.delete', log.id),
        method: 'delete',
      });
      if (response.value) {
        await this.get();
      }
    },
    async getCreationData() {
      await request({
        'url': route('logs.creating.data'),
        'method': 'GET'
      });
      if (response.value) {
        this.users = response.value?.data?.users.map((user: Users) => ({
          value: user.id,
          label: user.first_name + ' ' + user.last_name
        }));
        this.tables = response.value?.data?.tables.map((table: { Tables_in_laravel: any; }) => {
          const tableName = table.Tables_in_laravel;
          return {
            value: tableName,
            label: tableName.replace(/[^a-zA-Z0-9]/g, ' ')
          };
        });
      }
    },

    setCurrentLog(log: AuditLog) {
      this.currentLog = log;
    }
  },
});
