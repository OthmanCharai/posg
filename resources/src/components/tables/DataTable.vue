<script setup lang="ts">
import type { AntPagination } from '@common/types/global/pagination';
import { Table } from 'ant-design-vue';

const props = defineProps<{
  columns: Array<object>,
  data: Array<object>,
  fetchedData: Function
  currentPage?: Number,
  total?: Number,
  loading?: boolean
}>();

const onChange = async (pagination: AntPagination)  => {
  await props.fetchedData(pagination.current);
  console.log("params", pagination);
};

</script>

<template>
  <div class="table-responsive">
    <Table
      outlined
      :columns="columns"
      :data-source="data"
      :pagination="{
        current: currentPage,
        total: total,
        pageSize: 10
      }"
      :loading="loading"
      @change="onChange"
    >
      <template v-for="(slotName, index) in Object.keys($slots)" :key="index" v-slot:[slotName]="slotProps">
        <slot :name="slotName" v-bind="slotProps"></slot>
      </template>
    </Table>
  </div>
</template>

<style>
.ant-tooltip {
  display: none !important;
}
</style>
