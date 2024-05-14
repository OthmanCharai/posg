<script setup lang="ts">
  import ArticleDetails from './partials/ArticleDetails.vue';
  import ArticleIsoList from './partials/article-iso/ArticleIsoList.vue';
  import ArticleDepotsList from './partials/article-depots/ArticleDepotsList.vue';
  import { useArticlesStore } from '@stores/articles.store';

  const store = useArticlesStore();
  const activeKey = ref('1');

  onMounted(() => {
    if(store.selectedArticle.id) {
      store.getArticleById(store.selectedArticle.id);
    }
  });
</script>

<template>
  <PageHeader :title="store.selectedArticle.id ? 'Modifier l\'article' : 'Nouveau article'">
    <router-link :to="{ name: 'articles' }">
      <a-button type="primary">
        <vue-feather :size="16" type="arrow-left" />
        <span>Précédent</span>
      </a-button>
    </router-link>
  </PageHeader>

  <a-tabs
    v-model:activeKey="activeKey"
    type="line"
    size="large"
    :tabBarGutter="60"
    :destroyInactiveTabPane="true"
    :animated="true"
  >
    <a-tab-pane
      key="1"
      tab="Information de l'article"
      :forceRender="true"
    >
      <ArticleDetails v-if="activeKey === '1'" />
    </a-tab-pane>
    <a-tab-pane
      key="2"
      tab="ISO"
      :forceRender="true"
      v-if="store.selectedArticle.id"
    >
      <ArticleIsoList v-if="activeKey === '2'" />
    </a-tab-pane>
    <a-tab-pane
      key="3"
      tab="Dépots"
      :forceRender="true"
      v-if="store.selectedArticle.id"
    >
      <ArticleDepotsList v-if="activeKey === '3'" />
    </a-tab-pane>
    <a-tab-pane
      key="4"
      tab="Historique des ventes"
      :forceRender="true"
      v-if="store.selectedArticle.id"
    >
      <span v-if="activeKey === '4'">
        Not yet available
      </span>
    </a-tab-pane>
  </a-tabs>
</template>
