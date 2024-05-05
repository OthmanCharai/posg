<script setup lang="ts">
  import { useLogStore } from '@stores/log.store';

  const store = useLogStore();
  onMounted(async () => {
    await store.get();
  });

  const columns = computed(() => [
    {
      title: 'Utilisateur',
      customRender: ({ record }) => {
        return record.user.email;
      },
    },
    {
      title: 'Action',
      dataIndex: 'log_type',
    },
    {
      title: 'Pc',
      customRender: ({ record }) => {
        return record.request_info.ip;
      },
    },
    {
      title: 'Temps',
      dataIndex: 'humanize_datetime',
    },
  ]);
</script>
<template>
  <PageHeader title="Logs"> </PageHeader>

  <div class="card table-list-card">
    <Filter />
    <div class="card-body">
      <DataTable
        :columns="columns"
        :data="store.logs"
        :current-page="store.pagination.current_page"
        :total="store.pagination.total"
        :fetched-data="store.get"
        :loading="store.loading"
      >
      </DataTable>
    </div>
  </div>
</template>
