import { defineStore } from 'pinia';
import type { ArticleInfo } from '@common/types/articles';
import { route, useAxios } from '@utils/axios-helper';
import type { Depot } from '@common/types/global/depot';
import { Toast } from '@utils/toast';
import { useArticlesStore } from './articles.store';

const articleStore = useArticlesStore();
const { request, response, loading } = useAxios();

export const useArticleDepotStore = defineStore('Depot', {
  state: () => ({
    depotsData: [] as Depot[],
    currentArticleDepot: {} as Depot,
    currentIndex: null as null | number,
    depots: [] as Depot[],
    loading: loading,
  }),
  actions: {
    async create(data: Depot, selectedArticle: ArticleInfo, showCreateModal: Ref<boolean>) {
      await request({
        url: route('article-depots.create', selectedArticle.id),
        method: 'POST',
        data: data
      });
      if (response.value) {
        Toast.success('Votre dépot a été crée avec succès.');
        await articleStore.getArticleById(articleStore.articleId);
        showCreateModal.value = false;
      }
    },

    async update(data: Depot, selectedArticle: Depot, showUpdateModal: Ref<boolean>) {
      await request({
        url: route('article-depots.update', selectedArticle.id),
        method: 'PUT',
        data: data
      });
      if (response.value) {
        Toast.success('Votre dépot a été mis à jour avec succès.');
        await articleStore.getArticleById(articleStore.articleId);
        showUpdateModal.value = false;
      }
    },

    setCurrentArticleDepot(data: Depot, index: number) {
      this.currentArticleDepot = data;
      this.currentIndex = index;
    },

    // get Dépots dropdownList
    async get() {
      await request({
        url: route('depots.index'),
        method: 'GET',
      });

      if (response.value && response.value.data) {
        this.depots = response.value.data.depot.data;
      }
    },
  }
});
