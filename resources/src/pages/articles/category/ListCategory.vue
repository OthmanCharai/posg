<script setup lang="ts">
import {lengthSorter} from '@/src/composables/table-sorters';
import UpdateCategory from './UpdateCategory.vue';
import {useArticleCategoryStore} from "@stores/articleCategory.store";
import {ArticleCategory} from "@common/types/global/articleCategory";
import CreateCategory from "@pages/articles/category/CreateCategory.vue";

const store = useArticleCategoryStore();
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

// Edit user
const editCategory = (record: ArticleCategory) => {
  store.setCurrentArticle(record);
  showUpdateModal.value = true;
}

// Delete user
const showDeleteModal = ref<boolean>(false);
const deleteCategory = (record: ArticleCategory) => {
  store.setCurrentArticle(record);
  showDeleteModal.value = true;
}

onMounted(async () => {
  await store.get();
})
</script>

<template>
  <PageHeader title="Article Categories">
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
          :data="store.categories"
          :current-page="store.pagination.current_page"
          :total="store.pagination.total"
          :fetched-data="store.get"
          :loading="store.loading"
      >
        <template #bodyCell="{column, record}">
          <template v-if="column.key === 'action'">
            <td class="action-table-data">
              <button class="action-button edit" @click="editCategory(record)">
                <vue-feather type="edit"></vue-feather>
              </button>
              <button class="action-button delete" @click="deleteCategory(record)">
                <vue-feather type="trash-2"></vue-feather>
              </button>
            </td>
          </template>
        </template>
      </DataTable>
    </div>
  </div>
  <!-- Create user modal -->
  <CreateCategory v-if="store.getResponse && showCreateModal"/>
  <!-- Update user modal -->
  <UpdateCategory v-if="store.getResponse && showUpdateModal"/>
  <!-- Delte user Alert -->
  <DeleteAlert
      v-if="store.getResponse && showDeleteModal"
      v-model:toggle="showDeleteModal"
      model="article-categories"
      :id="store.currentCategory.id"
      :update-data="() => store.get(store.pagination.current_page)"
  />
</template>
