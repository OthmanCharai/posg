import {defineStore} from "pinia";
import type {ArticleCompatibility} from "@common/types/compatibility";
import type {PaginationMetadata} from "@common/types/global/pagination";
import {route, useAxios} from "@utils/axios-helper";
import {extractPaginatorObject} from "@utils/pagination";
import {Toast} from "@utils/toast";

const {request, response, loading} = useAxios();

export const useArticleCompatibilityStore = defineStore('compatibilities', {
    state: () => ({
        compatibilities: [] as ArticleCompatibility[],
        currentCompatibility: {} as ArticleCompatibility,
        pagination: {} as PaginationMetadata,
        loading: loading,
        getResponse: false,
    }),
    actions: {
        async get(page: number = 1) {
            await request({
                url: route('compatibilities.index', `page=${page}`),
                method: 'GET'
            });
            if (response.value && response.value.data) {
                this.compatibilities = response.value.data
                this.pagination = extractPaginatorObject(response.value.data);
                this.getResponse = true;
            }
        },

        async create(data: ArticleCompatibility, showCreateModal: Ref<boolean>) {
            await request({
                url: route('compatibilities.create.submit'),
                method: 'POST',
                data: data
            });
            if (response.value) {
                Toast.success('Votre compatibilité a été crée avec succès.');
                showCreateModal.value = false;
                await this.get();
            }
        },

        async update(articleCategory: ArticleCompatibility, data: ArticleCompatibility, showUpdateModal: Ref<boolean>) {
            await request({
                url: route('compatibilities.update', articleCategory.id),
                method: "PUT",
                data: data
            });
            if (response.value) {
                Toast.success('Votre compatibilité a été mis à jour avec succès.');
                showUpdateModal.value = false;
                await this.get();
            }
        },
        setCurrentCompatibility(data: ArticleCompatibility) {
            this.currentCompatibility = data;
        }
    }
});
