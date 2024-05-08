import { defineStore } from 'pinia';
import type { ArticleInfo, ArticleDepots } from '@common/types/articles';
import { route, useAxios } from '@utils/axios-helper';
import { Toast } from '@utils/toast';
import { useArticlesStore } from './articles.store';

const store = useArticlesStore();
const { request, response, loading } = useAxios();

export const useArticleDepotStore = defineStore('articleDepots', {
  state: () => ({
    depotsData: [] as ArticleDepots[],
    currentArticleDepot: {} as ArticleDepots,
    currentIndex: null as null | number,
    loading: loading,
  }),
  actions: {
    async create(data: ArticleDepots, selectedArticle: ArticleInfo, showCreateModal: Ref<boolean>) {
      await request({
        url: route('article-depots.create', selectedArticle.id),
        method: 'POST',
        data: data
      });
      if (response.value) {
        Toast.success('Votre dépot a été crée avec succès.');
        showCreateModal.value = false;
        await store.get();
      }
    },

    async update(data: ArticleDepots, selectedArticle: ArticleInfo, showUpdateModal: Ref<boolean>) {
      await request({
        url: route('article-depots.update', selectedArticle.id),
        method: 'PUT',
        data: data
      });
      if (response.value) {
        Toast.success('Votre dépot a été mis à jour avec succès.');
        showUpdateModal.value = false;
      }
    },
    setCurrentArticleDepot(data: ArticleDepots, index: number) {
      this.currentIndex = index;
      this.currentArticleDepot = data;
    }
  }
});
