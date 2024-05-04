<script setup lang="ts">
import {lengthSorter} from '@/src/composables/table-sorters';
import {useBrandStore} from "@stores/brand.store";
import type {Brand} from "@common/types/global/brand";
import CreateBrand from "@pages/articles/brand/CreateBrand.vue";
import UpdateBrand from "@pages/articles/brand/UpdateBrand.vue";

const store = useBrandStore();
const columns = computed(() => [
  {
    title: "Logo",
    dataIndex: "path",
  },
  {
    title: "Nom",
    dataIndex: "name",
    sorter: lengthSorter('name'),
  },
  {
    title: "abbreviation",
    dataIndex: "abbreviation",
    sorter: lengthSorter('abbreviation'),
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

// Edit brand
const editBrand = (record: Brand) => {
  store.setCurrentBrand(record);
  showUpdateModal.value = true;
}

// Delete brand
const showDeleteModal = ref<boolean>(false);
const deleteBrand = (record: Brand) => {
  store.setCurrentBrand(record);
  showDeleteModal.value = true;
}

onMounted(async () => {
  await store.get();
})
</script>

<template>
  <PageHeader title="Marque">
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
          :data="store.brands"
          :current-page="store.pagination.current_page"
          :total="store.pagination.total"
          :fetched-data="store.get"
          :loading="store.loading"
      >
        <template #bodyCell="{column, record}">
          <template v-if="column.dataIndex === 'path'">
            <img :src="record.path" :alt="record.name" class="w-[100px] h-[70px] object-cover rounded-md" />
          </template>
          <template v-if="column.key === 'action'">
            <td class="action-table-data">
              <button class="action-button edit" @click="editBrand(record)">
                <vue-feather type="edit"></vue-feather>
              </button>
              <button class="action-button delete" @click="deleteBrand(record)">
                <vue-feather type="trash-2"></vue-feather>
              </button>
            </td>
          </template>
        </template>
      </DataTable>
    </div>
  </div>
  <!-- Create user modal -->
  <CreateBrand v-if="store.getResponse && showCreateModal"/>
  <!-- Update user modal -->
  <UpdateBrand v-if="store.getResponse && showUpdateModal"/>
  <!-- Delte user Alert -->
  <DeleteAlert
      v-if="store.getResponse && showDeleteModal"
      v-model:toggle="showDeleteModal"
      model="brands"
      :id="store.currentBrand.id"
      :update-data="() => store.get(store.pagination.current_page)"
  />
</template>
