import { defineStore } from 'pinia';
import { Depot } from '@common/types/global/depot';
import { PaginationMetadata } from '@common/types/global/pagination';
import { route, useAxios } from '@utils/axios-helper';
import { extractPaginatorObject } from '@utils/pagination';
import { Toast } from '@utils/toast';

const { request, response, loading } = useAxios();

export const useDepotStore = defineStore('depots', {
  state: () => ({
    depots: [] as Depot[],
    currentDepot: {} as Depot,
    pagination: {} as PaginationMetadata,
    loading: loading,
    getResponse: false,
  }),
  actions: {
    async get(page: number = 1) {
      await request({
        url: route('depots.index', `page=${page}`),
        method: 'GET',
      });

      if (response.value && response.value?.data) {
        this.depots = response.value?.data.depots.data;
        this.pagination = extractPaginatorObject(response.value?.data.depots);
        this.getResponse = true;
      }
    },

    async create(data: any, showCreateModal: Ref<boolean>) {
      await request({
        url: route('depots.create'),
        method: 'POST',
        data: data,
      });

      if (response.value) {
        await Toast.success('depot a été crée avec succès.');
        showCreateModal.value = false;
        await this.get();
      }
    },

    async update(depot: Depot, data: any, showUpdateModal: Ref<boolean>) {
      await request({
        url: route('depots.update', depot.id),
        method: 'PUT',
        data: data,
      });

      if (response.value) {
        await Toast.success('depot a été mis à jour avec succès.');
        showUpdateModal.value = false;
        await this.get();
      }
    },

    async delete(depot: Depot) {
      await request({
        url: route('depots.delete', depot.id),
        method: 'DELETE',
      });

      if (response.value) {
        await this.get();
      }
    },

    setCurrentDepot(depot: Depot) {
      this.currentDepot = depot;
    },
  },
});
