import { defineStore } from 'pinia';
import type { ArticleInfo, ArticleIso } from '@common/types/articles';
import { route, useAxios } from '@utils/axios-helper';
import { Toast } from '@utils/toast';
import { useArticlesStore } from './articles.store';

const articleStore = useArticlesStore();
const { request, response, loading } = useAxios();

export const useArticleIsoStore = defineStore('articleIso', {
  state: () => ({
    isoData: [] as ArticleIso[],
    currentArticleIso: {} as ArticleIso,
    loading: loading,
  }),
  actions: {
    async create(data: ArticleIso, selectedArticle: ArticleInfo, showCreateModal: Ref<boolean>) {
      await request({
        url: route('article-iso.create', selectedArticle.id),
        method: 'POST',
        data: data
      });
      if (response.value) {
        Toast.success('Votre ISO a été crée avec succès.');
        await articleStore.getArticleById(articleStore.articleId);
        showCreateModal.value = false;
      }
    },

    async update(data: ArticleIso, selectedArticle: ArticleIso, showUpdateModal: Ref<boolean>) {
      await request({
        url: route('article-iso.update', selectedArticle.id),
        method: 'PUT',
        data: data
      });
      if (response.value) {
        Toast.success('Votre ISO a été mis à jour avec succès.');
        await articleStore.getArticleById(articleStore.articleId);
        showUpdateModal.value = false;
      }
    },

    setCurrentArticleIso(data: ArticleIso) {
      this.currentArticleIso = data;
    }
  }
});
