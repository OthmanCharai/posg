<script setup lang="ts">
  import { useLogStore } from '@stores/log.store';
  import {Roles} from "@common/types/global/roles";
  import {AuditLog} from "@common/types/global/log";
  import UpdateLogs from "@pages/admin/tracability/UpdateLogs.vue";
  import CreateLogs from "@pages/admin/tracability/CreateLogs.vue";

  const store = useLogStore();
  onMounted(async () => {
    await store.get();
    await store.getCreationData();
  });

  const columns = computed(() => [
    {
      title: 'traçabilité',
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
    {
      title: 'Action',
      key: 'action',
    },
  ]);
  const showCreateModal = ref(false);
  provide('showCreateModal', showCreateModal);

  const showUpdateModal = ref(false);
  provide('showUpdateModal', showUpdateModal);

  // Edit Role
  const editLog = (record: AuditLog) => {
    store.setCurrentLog(record);
    showUpdateModal.value = true;
  };

  // Delete Role
  const showDeleteModal = ref<boolean>(false);
  const deleteLog = (record: AuditLog) => {
    store.setCurrentLog(record);
    showDeleteModal.value = true;
  }
</script>
<template>
  <PageHeader title="Logs">
    <a-button type="primary" @click="showCreateModal = true">
      <vue-feather :size="16" type="plus-circle" />
      <span>Ajouter</span>
    </a-button>
  </PageHeader>

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
        <template #bodyCell="{ column, record }">
          <template v-if="column.key === 'action'">
            <td class="action-table-data">
              <button class="action-button edit" @click="editLog(record)">
                <vue-feather type="edit" />
              </button>
              <button class="action-button delete" @click="deleteLog(record)">
                <vue-feather type="trash-2" />
              </button>
            </td>
          </template>
        </template>
      </DataTable>
    </div>
  </div>
  <!-- Create role modal -->
  <CreateLogs v-if="store.getResponse && showCreateModal" />
  <!-- Update role modal -->
  <UpdateLogs v-if="store.getResponse && showUpdateModal" />
  <!-- Delete role Alert -->
  <DeleteAlert
      v-if="store.getResponse && showDeleteModal"
      v-model:toggle="showDeleteModal"
      model="logs"
      :id="store.currentLog.id"
      :update-data="() => store.get(store.pagination.current_page)"
  />
</template>
