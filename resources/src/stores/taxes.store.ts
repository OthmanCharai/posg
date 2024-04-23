import { defineStore } from 'pinia';
import { useAxios, route } from '@utils/axios-helper';
import { Toast } from '@utils/toast';
import type { Taxes } from '@common/types/taxes';

const { request, response, loading } = useAxios();

export const useTaxeStore = defineStore('taxes', {
  state: () => ({
    taxesList: {} as Taxes,
    loading: loading,
    getResponse: false,
    selectedTaxe: {} as Taxes,
  }),

  actions: {
    // global tax list
    async getTaxesList () {
      await request({
        method: 'GET',
        url: route('tax.list')
      })
      if (response.value && response.value.data) {
        console.log(response.value);
        this.taxesList = response.value.data;
        this.getResponse = true;
      }
    },
    /* ------------------- Taxe parent -------------------- */
    // Create
    async createTaxe (formData: Taxes, showCreateModal: Ref<boolean>) {
      await request({
        method: 'POST',
        url: route('tax.create.submit'),
        data: formData,
      })

      if (response.value && response.value.data) {
        Toast.success('Votre taxe a été crée avec succès.');
        showCreateModal.value = false;
        await this.getTaxesList();
      }
    },

    // Update
    async updateUser (formData: Taxes, showUpdateModal: Ref<boolean>) {
      await request({
        method: 'PUT',
        url: route('tax.update', this.selectedTaxe.id),
        data: formData,
      })

      if (response.value && response.value.data) {
        Toast.success('Votre taxe a été modifié avec succès.');
        showUpdateModal.value = false;
        await this.getTaxesList();
      }
    },

    setSelectedTaxe(data: Taxes) {
      this.selectedTaxe = data;
    },
    /* ------------------- Taxe variants -------------------- */
    // Create

    // Update
  }
})
