import { defineStore } from 'pinia';
import type { Supplier } from '@common/types/global/supplier';
import type { PaginationMetadata } from '@common/types/global/pagination';
import { route, useAxios } from '@utils/axios-helper';
import { extractPaginatorObject } from '@utils/pagination';
import { Toast } from '@utils/toast';

const { request, response, loading } = useAxios();

export const useSupplierStore = defineStore('supplier', {
    state: () => ({
        suppliers: [] as Supplier[],
        currentSupplier: {} as Supplier,
        pagination: {} as PaginationMetadata,
        loading: loading,
        getResponse: false,
    }),
    actions: {
        async get(page: number = 1) {
            await request({
                url: route('suppliers.index', `page=${page}`),
                method: 'GET'
            })
            if (response.value && response.value?.data) {
                this.suppliers = response.value?.data.suppliers.data;
                this.pagination = extractPaginatorObject(response.value?.data.suppliers.data);
                this.getResponse = true;
            }
        },
        async create(data: Supplier, showCreateModal: Ref<boolean>) {
            await request({
                url: route('suppliers.create'),
                method: 'POST',
                data: data
            });
            if (response.value && response.value?.data) {
                Toast.success('Votre Fournisseurs a été ajouter avec succès.');
                showCreateModal.value = false;
                await this.get();
            }
        },
        async update(supplier: Supplier, data: Supplier, showUpdateModal: Ref<boolean>) {
            await request({
                url: route('supplier.update', supplier.id),
                method: 'PUT',
                data: data
            });
            if (response.value && response.value?.data) {
                Toast.success('Votre Fournisseurs a été modifier avec succès.');
                showUpdateModal.value = false;
                await this.get();
            }
        },
        async delete(supplier: Supplier) {
            await request({
                url: route('supplier.delete', supplier.id),
                method: 'delete'
            });
            if (response.value) {
                Toast.success('Votre Fournisseurs a été supprimer avec succès.');
                await this.get();
            }
        },
        setCurrentSupplier(supplier: Supplier) {
            this.currentSupplier = supplier;
        }
    }
})
