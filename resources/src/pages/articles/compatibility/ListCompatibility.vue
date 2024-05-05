<script setup lang="ts">
import { lengthSorter } from '@/src/composables/table-sorters';
import CreateCompatibility from "./CreateCompatibility.vue";
import UpdateCompatibility from './UpdateCompatibility.vue';
import { useArticleCompatibilityStore } from "@stores/compatibility.store";
import type { ArticleCompatibility } from "@common/types/compatibility";

const store = useArticleCompatibilityStore();
const columns = computed(() => [
  {
    title: "Nom",
    dataIndex: "name",
    sorter: lengthSorter('name'),
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

// Edit compatibility
const editCompatibility = (record: ArticleCompatibility) => {
  store.setCurrentCompatibility(record);
  showUpdateModal.value = true;
}

// Delete compatibility
const showDeleteModal = ref<boolean>(false);
const deleteCompatibility = (record: ArticleCompatibility) => {
  store.setCurrentCompatibility(record);
  showDeleteModal.value = true;
}

onMounted(async () => {
  await store.get();
})
</script>

<template>
  <PageHeader title="Compatibilité">
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
          :data="store.compatibilities"
          :current-page="store.pagination.current_page"
          :total="store.pagination.total"
          :fetched-data="store.get"
          :loading="store.loading"
      >
        <template #bodyCell="{column, record}">
          <template v-if="column.key === 'action'">
            <td class="action-table-data">
              <button class="action-button edit" @click="editCompatibility(record)">
                <vue-feather type="edit"></vue-feather>
              </button>
              <button class="action-button delete" @click="deleteCompatibility(record)">
                <vue-feather type="trash-2"></vue-feather>
              </button>
            </td>
          </template>
        </template>
      </DataTable>
    </div>
  </div>
  <!-- Create modal -->
  <CreateCompatibility v-if="store.getResponse && showCreateModal"/>
  <!-- Update modal -->
  <UpdateCompatibility v-if="store.getResponse && showUpdateModal"/>
  <!-- Delte Alert -->
  <DeleteAlert
    v-if="store.getResponse && showDeleteModal"
    v-model:toggle="showDeleteModal"
    model="compatibilities"
    :id="store.currentCompatibility.id"
    :update-data="() => store.get(store.pagination.current_page)"
  />
</template>
