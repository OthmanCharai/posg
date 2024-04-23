import { defineStore } from 'pinia';
import { useAxios, route } from '@utils/axios-helper';
import { Toast } from '@utils/toast';
import type { Taxes } from '@common/types/taxes';

const { request, response, loading } = useAxios();

export const useUserStore = defineStore('users', {
  state: () => ({
    taxesList: {} as Taxes,
    loading: loading,
    getResponse: false,
  }),

  actions: {
    // global tax list
    async getTaxesList () {
      await request({
        method: 'GET',
        url: route('taxes.index')
      })
      if (response.value && response.value.data) {
        this.taxesList = response.value.data.users.data;
        this.getResponse = true;
      }
    },
    /* ------------------- Taxe parent -------------------- */
    // Create
    async createTaxe (formData: 'data', showCreateModal: Ref<boolean>) {
      await request({
        method: 'POST',
        url: route('taxe.create'),
        data: formData,
      })

      if (response.value && response.value.data) {
        Toast.success('Votre taxe a été crée avec succès.');
        showCreateModal.value = false;
        await this.getTaxesList();
      }
    },

    // Update
    async updateUser (formData: FormData, showUpdateModal: Ref<boolean>) {
      await request({
        method: 'POST',
        url: route('users.update', this.selectedUser.id),
        data: formData,
        headers: {
          "Content-Type": "multipart/form-data",
        },
        params: {
          _method: "PUT",
        },
      })

      if (response.value && response.value.data) {
        Toast.success('Votre compte a été mis à jour avec succès.');
        showUpdateModal.value = false;
        await this.getUsersList(this.pagination.current_page);
      }
    },


    // Delete

    /* ------------------- Taxe variants -------------------- */
    // Create

    // Update

    // Delete
  }
})
