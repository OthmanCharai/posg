<script setup lang="ts">
  import ArticleDetails from './partials/ArticleDetails.vue';
  import { useArticlesStore } from '@stores/articles.store';

  const store = useArticlesStore();

  const activeKey = ref('1');
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
      <span v-if="activeKey === '1'">
        <ArticleDetails />
      </span>
    </a-tab-pane>
    <a-tab-pane
      key="2"
      tab="ISO"
      :forceRender="true"
    >
      <span v-if="activeKey === '2'">
        content 2
      </span>
    </a-tab-pane>
    <a-tab-pane
      key="3"
      tab="Stock"
      :forceRender="true"
    >
      <span v-if="activeKey === '3'">
        content 3
      </span>
    </a-tab-pane>
    <a-tab-pane
      key="4"
      tab="Historique des ventes"
      :forceRender="true"
    >
      <span v-if="activeKey === '4'">
        content 4
      </span>
    </a-tab-pane>
  </a-tabs>
</template>
