<script setup lang="ts">
defineProps<{
  columns?: Array<object>,
  data?: Array<object>,
  currentPage?: Number,
}>();

const onChange = (pagination: any, filters: any, sorter: any, extra: any) => {
  console.log("params", pagination, filters, sorter, extra);
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
        pageSize: 10
      }"
      @change="onChange"
    />
  </div>
</template>

<style>
.ant-tooltip {
  display: none !important;
}
</style>
