import { defineStore } from 'pinia';
import { Brand } from '@common/types/global/brand';
import { PaginationMetadata } from '@common/types/global/pagination';
import { route, useAxios } from '@utils/axios-helper';
import { extractPaginatorObject } from '@utils/pagination';
import { Toast } from '@utils/toast';

const { request, response, loading } = useAxios();

export const useBrandStore = defineStore('brands', {
  state: () => ({
    brands: [] as Brand[],
    currentBrand: {} as Brand,
    pagination: {} as PaginationMetadata,
    loading: loading,
    getResponse: false,
  }),
  actions: {
    async get(page: number = 1) {
      await request({
        url: route('brands.index', `page=${page}`),
        method: 'GET',
      });
      if (response.value && response.value?.data) {
        this.brands = response.value?.data.brands.data;
        this.pagination = extractPaginatorObject(response.value?.data.brands);
        this.getResponse = true;
      }
    },

    async create(data: FormData, showCreateModal: Ref<boolean>) {
      await request({
        url: route('brands.create'),
        method: 'POST',
        data: data,
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
      if (response.value) {
        Toast.success('marque a été crée avec succès.');
        showCreateModal.value = false;
        await this.get();
      }
    },

    async update(brand: Brand, data: FormData, showUpdateModal: Ref<boolean>) {
      await request({
        url: route('brands.update', brand.id),
        method: 'POST',
        data: data,
        headers: {
          'Content-Type': 'multipart/form-data',
        },
        params: {
          _method: 'PUT',
        },
      });

      if (response.value) {
        Toast.success('marque a  été mis à jour avec succès.');
        showUpdateModal.value = false;
        await this.get();
      }
    },

    async delete(brand: Brand) {
      await request({
        url: route('brands.delete', brand.id),
        method: 'DELETE',
      });

      if (response.value) {
        await this.get();
      }
    },

    setCurrentBrand(brand: Brand) {
      this.currentBrand = brand;
    },
  },
});
