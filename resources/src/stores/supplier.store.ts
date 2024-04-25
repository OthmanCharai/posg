import {defineStore} from "pinia";
import {Supplier} from "@common/types/global/supplier";
import {PaginationMetadata} from "@common/types/global/pagination";
import {route, useAxios} from '@utils/axios-helper';
import {extractPaginatorObject} from "@utils/pagination";
import {Toast} from "@utils/toast";

const {request, response, loading} = useAxios();

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
                this.suppliers = response.value?.data.suppliers;
                this.pagination = extractPaginatorObject(response.value?.data.suppliers);
                this.getResponse = true;
            }
        },
        async create(data: any, showCreateModal: Ref<boolean>) {
            await request({
                url: route('suppliers.create'),
                method: 'POST',
                data: data
            });
            if (response.value && response.value?.data) {
                await Toast.success('Votre Fournisseurs a été ajouter avec succès.');
                showCreateModal.value = false;
                await this.get();
            }
        },
        async update(supplier: Supplier, data: any, showUpdateModal: Ref<boolean>) {
            await request({
                url: route('supplier.update', supplier.id),
                method: 'PUT',
                data: data
            });
            if (response.value && response.value?.data) {
                await Toast.success('Votre Fournisseurs a été modifier avec succès.');
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
                await Toast.success('Votre Fournisseurs a été supprimer avec succès.');
                await this.get();
            }
        },
        setCurrentSupplier(supplier: Supplier) {
            this.currentSupplier = supplier;
        }
    }
})
