<script setup lang="ts">
import type { AntPagination } from '@common/types/global/pagination';

const props = defineProps<{
  columns: Array<object>,
  data: Array<object>,
  currentPage?: Number,
  total?: Number
  fetchedData: Function
  loading?: boolean
}>();

const onChange = async (pagination: AntPagination)  => {
  await props.fetchedData(pagination.current);
  console.log("params", pagination);
};

</script>

<template>
  <div class="table-responsive">
    <a-table
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
    />
  </div>
</template>

<style>
.ant-tooltip {
  display: none !important;
}
</style>
