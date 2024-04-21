<script setup lang="ts">
import {lengthSorter} from '@/src/composables/table-sorters';
import {useRoleStore} from "@/src/stores/roles";
import {Roles} from "@common/types/global/roles";
import CreateRole from "@pages/admin/roles/CreateRole.vue";
import UpdateRole from "@pages/admin/roles/UpdateRole.vue";

const store = useRoleStore();

const columns = computed(() => [
  {
    title: "Nome",
    dataIndex: "name",
    sorter: lengthSorter('name'),
  },
  {
    title: "Description",
    dataIndex: "description",
    sorter: lengthSorter('description'),
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
const editRole = (record: Roles) => {
  store.setCurrentRoleData(record);
  showUpdateModal.value = true;
}

// Delete Role
const showDeleteAlert = ref<boolean>(false);
const deleteRole = (record: Roles) => {
  store.setCurrentRoleData(record);
  showDeleteAlert.value = true;
}

onMounted(async () => {
  await store.getRolesList();
})
</script>

<template>
  <PageHeader title="Roles">
    <div class="page-btn">
      <a
          href="javascript:void(0);"
          class="btn btn-added color"
          @click="showCreateModal = true"
      >
        <vue-feather type="plus-circle" class="me-2"></vue-feather>
        Ajouter
      </a>
    </div>
  </PageHeader>

  <div class="card table-list-card">
    <Filter/>
    <div class="card-body">
      <DataTable
          :columns="columns"
          :data="store.roles"
          :current-page="store.pagination.current_page"
          :total="store.pagination.total"
          :fetched-data="store.getRolesList"
          :loading="store.loading"
      >
        <template #bodyCell="{column, record}">
          <template v-if="column.key === 'action'">
            <td class="action-table-data">
              <button class="action-button edit" @click="editRole(record)">
                <vue-feather type="edit"></vue-feather>
              </button>
              <button class="action-button delete" @click="deleteRole(record)">
                <vue-feather type="trash-2"></vue-feather>
              </button>
            </td>
          </template>
        </template>
      </DataTable>
    </div>
  </div>
  <!-- Create role modal -->
  <CreateRole v-if="store.getResponse && showCreateModal"/>
  <!-- Update role modal -->
  <UpdateRole v-if="store.getResponse && showUpdateModal"/>
  <!-- Delete role Alert -->
  <DeleteAlert
      v-if="store.getResponse && showDeleteAlert"
      v-model:toggle="showDeleteAlert"
      model="roles"
      :id="store.currentRole.id"
  />
</template>