import { defineStore } from 'pinia';
import { useAxios, route } from '@utils/axios-helper';
import { extractPaginatorObject } from '@utils/pagination';
import type { PaginationMetadata } from '@common/types/global/pagination';
import type { ArticleInfo } from '@common/types/articles';
import { Toast } from '@utils/toast';

const { request, response, loading } = useAxios();

export const useArticlesStore = defineStore('articles', {
  state: () => ({
    articlesData: [] as ArticleInfo[],
    selectedArticle: {} as ArticleInfo,
    pagination: {} as PaginationMetadata,
    loading: loading,
    getResponse: false,
  }),

  actions: {
    async get(page: number = 1) {
      await request({
        method: 'GET',
        url: route('articles.index', `page=${page}`)
      })
      if (response.value && response.value.data) {
        this.articlesData = response.value.data.users.data;
        this.pagination = extractPaginatorObject(response.value.data.users);
        this.getResponse = true;
      }
    },

    async create(formData: FormData) {
      await request({
        method: 'POST',
        url: route('articles.create.submit'),
        data: formData,
        headers: {
          "Content-Type": "multipart/form-data",
        },
      })

      if (response.value && response.value.data) {
        Toast.success('Votre article a été crée avec succès.');
      }
    },

    async update(formData: FormData) {
      await request({
        method: 'POST',
        url: route('articles.update', this.selectedArticle.id),
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
      }
    },

    setSelectedArticle(data: ArticleInfo) {
      this.selectedArticle = data;
    },
  }
})
