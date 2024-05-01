<script setup lang="ts">
import {lengthSorter} from '@/src/composables/table-sorters';
import {useSupplierStore} from "@stores/supplier.store";
import type {Supplier} from "@common/types/global/supplier";
import CreateSupplier from "@pages/supplier/CreateSupplier.vue";
import UpdateSupplier from "@pages/supplier/UpdateSupplier.vue";

const store = useSupplierStore();
const columns = computed(() => [
  {
    title: "Nom Société",
    dataIndex: "company_name",
    sorter: lengthSorter('company_name'),
  },
  {
    title: "Nom Fournisseur",
    customRender: ({record}) => {
      return record.first_name + " " + record.last_name;
    }
  },
  {
    title: "Email",
    dataIndex: "email",
    sorter: lengthSorter('email'),
  },
  {
    title: "Tél",
    dataIndex: "phone_number",
    sorter: lengthSorter('phone_number'),
  },
  {
    title: "Adresse",
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

// Edit supplier
const editSupplier = (record: Supplier) => {
  store.setCurrentSupplier(record);
  showUpdateModal.value = true;
}

// Delete supplier
const showDeleteModal = ref<boolean>(false);
const deleteSupplier = (record: Supplier) => {
  store.setCurrentSupplier(record);
  showDeleteModal.value = true;
}

onMounted(async () => {
  await store.get();
})
</script>

<template>
  <PageHeader title="Fournisseurs">
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
          :data="store.suppliers"
          :current-page="store.pagination.current_page"
          :total="store.pagination.total"
          :fetched-data="store.get"
          :loading="store.loading"
      >
        <template #bodyCell="{column, record}">
          <template v-if="column.key === 'action'">
            <td class="action-table-data">
              <button class="action-button edit" @click="editSupplier(record)">
                <vue-feather type="edit"></vue-feather>
              </button>
              <button class="action-button delete" @click="deleteSupplier(record)">
                <vue-feather type="trash-2"></vue-feather>
              </button>
            </td>
          </template>
        </template>
      </DataTable>
    </div>
  </div>
  <!-- Create supplier modal -->
  <CreateSupplier v-if="store.getResponse && showCreateModal"/>
  <!-- Update supplier  modal -->
  <UpdateSupplier v-if="store.getResponse && showUpdateModal"/>
  <!-- Delete supplier Alert -->
  <DeleteAlert
      v-if="store.getResponse && showDeleteModal"
      v-model:toggle="showDeleteModal"
      model="suppliers"
      :id="store.currentSupplier.id"
      :update-data="() => store.get(store.pagination.page)"
  />
</template>
