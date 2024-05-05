<script setup lang="ts">
  import Taxes from './partials/taxes/TaxesList.vue';
  import BankAccountList from '../bankAccount/BankAccountList.vue';
  import CompanyProfile from '../company/CompanyProfile.vue';

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
    <a-tab-pane
      key="1"
      tab="Information Société"
      :forceRender="true"
    >
      <span v-if="activeKey === '1'">
        <CompanyProfile />
      </span>
    </a-tab-pane>
    <a-tab-pane
      key="2"
      tab="Gestion de banques"
      :forceRender="true"
    >
      <span v-if="activeKey === '2'"> <BankAccountList /> </span>
    </a-tab-pane>
    <a-tab-pane
      key="3"
      tab="Gestion des taxes"
      :forceRender="true"
    >
      <Taxes v-if="activeKey === '3'" />
    </a-tab-pane>
  </a-tabs>
</template>
