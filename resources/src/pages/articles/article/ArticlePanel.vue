<script setup lang="ts">
import ArticleDetails from "./partials/ArticleDetails.vue";

const activeKey = ref("1");
</script>

<template>
  <PageHeader title="Article Crud">
    <router-link :to="{ name: 'articles' }">
      <a-button type="primary">
        <vue-feather :size="16" type="arrow-left"></vue-feather>
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
    <a-tab-pane key="1" tab="Information de l'article" :forceRender="true">
      <span v-if="activeKey === '1'">
        <ArticleDetails />
      </span>
    </a-tab-pane>
    <a-tab-pane key="2" tab="Compatibilité" :forceRender="true">
      <span v-if="activeKey === '2'">
        content 2
      </span>
    </a-tab-pane>
    <a-tab-pane key="3" tab="Stock" :forceRender="true">
      <span v-if="activeKey === '3'" >
        content 3
      </span>
    </a-tab-pane>
  </a-tabs>
</template>
