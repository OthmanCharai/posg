import { defineStore } from 'pinia';
import { AuditLog } from '@common/types/global/log';
import { useAxios } from '@utils/axios-helper';
import { extractPaginatorObject } from '@utils/pagination';
import { PaginationMetadata } from '@common/types/global/pagination';

const { request, response, loading } = useAxios();
export const useLogStore = defineStore('logs', {
  state: () => ({
    logs: [] as AuditLog[],
    pagination: {} as PaginationMetadata,
    getResponse: false,
    loading: loading,
  }),

  actions: {
    async get() {
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
  },
});
