<script setup lang="ts">
import Taxes from './partials/Taxes.vue';

const activeKey = ref('1');
</script>

<template>
  <PageHeader title="Administartion" />

  <a-tabs
    v-model:activeKey="activeKey"
    type="line"
    size="large"
    :tabBarGutter="60"
    :destroyInactiveTabPane="true"
    :animated="true"
  >
    <a-tab-pane key="1" tab="Information Société" :forceRender="true">
      <span v-if="activeKey === '1'">
        Content of Tab Pane 1
      </span>
    </a-tab-pane>
    <a-tab-pane key="2" tab="Gestion de banques" :forceRender="true">
      <span v-if="activeKey === '2'">
        Content of Tab Pane 2
      </span>
    </a-tab-pane>
    <a-tab-pane key="3" tab="Gestion des taxes" :forceRender="true">
      <Taxes v-if="activeKey === '3'"/>
    </a-tab-pane>
  </a-tabs>
</template>
