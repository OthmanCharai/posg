import {defineStore} from "pinia";
import {ArticleCategory} from "@common/types/global/articleCategory";
import {PaginationMetadata} from "@common/types/global/pagination";
import {route, useAxios} from "@utils/axios-helper";
import {extractPaginatorObject} from "@utils/pagination";
import {Toast} from "@utils/toast";

const {request, response, loading} = useAxios();

export const useArticleCategoryStore = defineStore('article-categories', {
    state: () => ({
        categories: [] as ArticleCategory[],
        currentCategory: {} as ArticleCategory,
        pagination: {} as PaginationMetadata,
        loading: loading,
        getResponse: false,
    }),
    actions: {
        async get(page: number = 1) {
            await request({
                url: route('article-categories.index', `page=${page}`),
                method: 'GET'
            });
            if (response.value && response.value?.data) {
                this.categories = response.value?.data.article_categories.data
                this.pagination = extractPaginatorObject(response.value?.data.article_categories);
                this.getResponse = true;
            }
        },

        async create(data: any, showCreateModal: Ref<boolean>) {
            await request({
                url: route('article-categories.create'),
                method: 'POST',
                data: data
            });
            if (response.value) {
                await Toast.success('article category a été crée avec succès.');
                showCreateModal.value = false;
                await this.get();
            }
        },

        async update(articleCategory: ArticleCategory, data: any, showUpdateModal: Ref<boolean>) {
            await request({
                url: route('article-categories.update', articleCategory.id),
                method: "PUT",
                data: data
            });
            if (response.value) {
                await Toast.success('article category a été mis à jour avec succès.');
                showUpdateModal.value = false;
                await this.get();
            }
        },

        async delete(articleCategory: ArticleCategory) {
            await request({
                url: route('article-categories.delete', articleCategory.id),
                method: "DELETE"
            });

            if (response.value) {
                await this.get();
            }
        },

        setCurrentArticle(articleCategory: ArticleCategory) {
            this.currentCategory = articleCategory;
        }
    }
});