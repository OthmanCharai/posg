<script setup lang="ts">
  import { lengthSorter, numericSorter } from '@/src/composables/table-sorters';
  import CreateArticleDepot from './CreateArticleDepot.vue';
  import UpdateArticleDepot from './UpdateArticleDepot.vue';
  import { useArticleDepotStore } from '@stores/articleDepot.store';
  import type { Depot } from '@common/types/global/depot';
  import { useArticlesStore } from '@stores/articles.store';

  const storeDepot = useArticleDepotStore();
  const articleStore = useArticlesStore();
  const columns = computed(() => [
    {
      title: 'Nome',
      dataIndex: 'name',
      sorter: lengthSorter('name'),
    },
    {
      title: 'Address',
      dataIndex: 'address',
      sorter: lengthSorter('address'),
    },
    {
      title: 'Quantité',
      dataIndex: 'quantity',
      sorter: numericSorter('quantity'),
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

  // Edit ArticleDepot
  const editArticleDepot = (record: Depot, index: number) => {
    storeDepot.setCurrentArticleDepot(record, index);
    showUpdateModal.value = true;
  };

  // Delete ArticleDepot
  const showDeleteModal = ref<boolean>(false);
  const deleteArticleDepot = (record: Depot, index: number) => {
    storeDepot.setCurrentArticleDepot(record, index);
    showDeleteModal.value = true;
  };
</script>

<template>
  <PageHeader>
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
        :data="articleStore.selectedArticle.depots ?? []"
        :fetched-data="() => []"
        :loading="storeDepot.loading"
      >
        <template #bodyCell="{column, record, index}">
          <template v-if="column.key === 'action'">
            <td class="action-table-data">
              <button class="action-button edit" @click="editArticleDepot(record, index)">
                <vue-feather type="edit" />
              </button>
              <button class="action-button delete" @click="deleteArticleDepot(record, index)">
                <vue-feather type="trash-2" />
              </button>
            </td>
          </template>
        </template>
      </DataTable>
    </div>
  </div>
  <!-- Create modal -->
  <CreateArticleDepot v-if="showCreateModal" />
  <!-- Update modal -->
  <UpdateArticleDepot v-if="showUpdateModal" />
  <!-- Delte Alert -->
  <DeleteAlert
    v-if="showDeleteModal"
    v-model:toggle="showDeleteModal"
    model="article-depots"
    :id="storeDepot.currentArticleDepot.id"
    :update-data="() => articleStore.getArticleById(articleStore.articleId)"
  />
</template>
