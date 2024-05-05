import { defineStore } from 'pinia';
import { Company } from '../common/types/global/company';
import { route, useAxios } from '@utils/axios-helper';
import { Toast } from '@utils/toast';

const { request, response, loading } = useAxios();

export const useCompanyStore = defineStore('company', {
  state: () => ({
    company: {} as Company,
  }),
  actions: {
    async create(data: any) {
      await request({
        method: 'POST',
        url: route('company-setting.create'),
        data: data,
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
      if (response.value && response.value.data) {
        this.company = response.value.data;
        Toast.success('Votre compte a été crée avec succès.');
      }
    },

    async get() {
      await request({
        method: 'GET',
        url: route('company-setting.show'),
      });

      if (response.value && response.value.data.company_setting) {
        this.company = response.value.data.company_setting;
      }
    },

    async update(company: Company, data: any) {
      await request({
        method: 'POST',
        url: route('company-setting.update', company.id),
        data: data,
        headers: {
          'Content-Type': 'multipart/form-data',
        },
        params: {
          _method: 'PUT',
        },
      });
      if (response.value && response.value.data) {
        Toast.success('les informations a été mis à jour avec succès.');
        this.company = response.value.data.company_setting;
      }
    },
  },
});
