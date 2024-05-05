<script setup lang="ts">
  import type { TablePaginationConfig } from 'ant-design-vue/lib/table/interface';

  const props = defineProps<{
    columns: Array<object>;
    data: Array<object>;
    fetchedData: Function;
    currentPage?: number;
    total?: number;
    loading?: boolean;
  }>();

  const onChange = async (pagination: TablePaginationConfig) => {
    await props.fetchedData(pagination.current);
  };
</script>

<template>
  <div class="table-responsive overflow-x-scroll">
    <a-table
      outlined
      :columns="columns"
      :data-source="data"
      :pagination="{
        current: currentPage as number | undefined,
        total: total as number | undefined,
        pageSize: 10,
      }"
      :loading="loading"
      @change="onChange"
    >
      <template
        v-for="(slotName, index) in Object.keys($slots)"
        :key="index"
        #[slotName]="slotProps"
      >
        <slot :name="slotName" v-bind="slotProps" />
      </template>
    </a-table>
  </div>
</template>

<style>
  .ant-tooltip {
    display: none !important;
  }
</style>
