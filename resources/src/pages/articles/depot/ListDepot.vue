<script setup lang="ts">
import {lengthSorter} from '@/src/composables/table-sorters';
import {useDepotStore} from "@stores/depot.store";
import {Depot} from "@common/types/global/depot";
import CreateDepot from "@pages/articles/depot/CreateDepot.vue";
import UpdateDepot from "@pages/articles/depot/UpdateDepot.vue";

const store = useDepotStore();
const columns = computed(() => [
  {
    title: "Nom",
    dataIndex: "name",
    sorter: lengthSorter('name'),
  },

  {
    title: "Address",
    dataIndex: "address",
    sorter: lengthSorter('address'),
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

// Edit user
const editDepot = (record: Depot) => {
  store.setCurrentDepot(record);
  showUpdateModal.value = true;
}

// Delete user
const showDeleteModal = ref<boolean>(false);
const deleteDepot = (record: Depot) => {
  store.setCurrentDepot(record);
  showDeleteModal.value = true;
}

onMounted(async () => {
  await store.get();
})
</script>

<template>
  <PageHeader title="Depot">
    <a-button type="primary" @click="showCreateModal = true">
      <vue-feather :size="16" type="plus-circle"></vue-feather>
      <span>Ajouter</span>
    </a-button>
  </PageHeader>

  <div class="card table-list-card">
    <Filter/>
    <div class="card-body">
      <DataTable
          :columns="columns"
          :data="store.depots"
          :current-page="store.pagination.current_page"
          :total="store.pagination.total"
          :fetched-data="store.get"
          :loading="store.loading"
      >
        <template #bodyCell="{column, record}">
          <template v-if="column.key === 'action'">
            <td class="action-table-data">
              <button class="action-button edit" @click="editDepot(record)">
                <vue-feather type="edit"></vue-feather>
              </button>
              <button class="action-button delete" @click="deleteDepot(record)">
                <vue-feather type="trash-2"></vue-feather>
              </button>
            </td>
          </template>
        </template>
      </DataTable>
    </div>
  </div>
  <!-- Create depot modal -->
  <CreateDepot v-if="store.getResponse && showCreateModal"/>
  <!-- Update depot modal -->
  <UpdateDepot v-if="store.getResponse && showUpdateModal"/>
  <!-- Delete user Alert -->
  <DeleteAlert
      v-if="store.getResponse && showDeleteModal"
      v-model:toggle="showDeleteModal"
      model="depots"
      :id="store.currentDepot.id"
      :update-data="() => store.get(store.pagination.current_page)"
  />
</template>
