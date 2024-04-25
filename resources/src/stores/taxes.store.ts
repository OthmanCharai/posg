import { defineStore } from 'pinia';
import { useAxios, route } from '@utils/axios-helper';
import { Toast } from '@utils/toast';
import type { Taxes, TaxeVariants } from '@common/types/taxes';

const { request, response, loading } = useAxios();

export const useTaxeStore = defineStore('taxes', {
  state: () => ({
    taxesList: [] as Taxes[],
    loading: loading,
    getResponse: false,
    selectedTaxe: {} as Taxes,
    selectedTaxeVariant: {} as TaxeVariants,
    selectedTaxeId: '' as string | undefined,
  }),

  actions: {
    // global tax list
    async getTaxesList() {
      await request({
        method: 'GET',
        url: route('tax.list')
      })
      if (response.value && response.value.data) {
        this.taxesList = response.value.data.taxes;
        this.getResponse = true;
      }
    },
    /* ------------------- Taxe parent -------------------- */
    // Create
    async createTaxe(formData: Taxes, showCreateModal: Ref<boolean>) {
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
    async updateTaxe(formData: Taxes, showUpdateModal: Ref<boolean>) {
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
    async createTaxeVariant(formData: TaxeVariants, showCreateModal: Ref<boolean>) {
      await request({
        method: 'POST',
        url: route('tax-variant.create.submit', this.selectedTaxeId),
        data: formData,
      })

      if (response.value && response.value.data) {
        Toast.success('Création faite avec succès.');
        showCreateModal.value = false;
        await this.getTaxesList();
      }
    },

    // Update
    async updateTaxeVariant (formData: TaxeVariants, showUpdateModal: Ref<boolean>) {
      await request({
        method: 'PUT',
        url: route('tax-variant.update', this.selectedTaxeVariant.id),
        data: formData,
      })

      if (response.value && response.value.data) {
        Toast.success('Modification faite avec succès.');
        showUpdateModal.value = false;
        await this.getTaxesList();
      }
    },

    setSelectedTaxeId(data: string | undefined) {
      this.selectedTaxeId = data;
    },

    setSelectedTaxeVariants(data: TaxeVariants) {
      this.selectedTaxeVariant = data;
    },
  }
})
