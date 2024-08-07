<script setup lang="ts">
  import { lengthSorter } from '@/src/composables/table-sorters';
  import CreateArticleIso from './CreateArticleIso.vue';
  import UpdateArticleIso from './UpdateArticleIso.vue';
  import { useArticleIsoStore } from '@stores/articleIso.store';
  import type { ArticleIso } from '@common/types/articles';
  import { useArticlesStore } from '@stores/articles.store';

  const storeIso = useArticleIsoStore();
  const articleStore = useArticlesStore();
  const columns = computed(() => [
    {
      title: 'Nome',
      dataIndex: 'name',
      sorter: lengthSorter('name'),
    },
    {
      title: 'Valeur',
      dataIndex: 'value',
      sorter: lengthSorter('value'),
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

  // Edit ArticleIso
  const editArticleIso = (record: ArticleIso) => {
    storeIso.setCurrentArticleIso(record);
    showUpdateModal.value = true;
  };

  // Delete ArticleIso
  const showDeleteModal = ref<boolean>(false);
  const deleteArticleIso = (record: ArticleIso) => {
    storeIso.setCurrentArticleIso(record);
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
        :data="articleStore.selectedArticle.article_iso ?? []"
        :fetched-data="() => []"
        :loading="storeIso.loading"
      >
        <template #bodyCell="{column, record, index}">
          <template v-if="column.dataIndex === 'name'">
            {{ 'ISO' + ' ' + (index + 1) }}
          </template>

          <template v-if="column.key === 'action'">
            <td class="action-table-data">
              <button class="action-button edit" @click="editArticleIso(record)">
                <vue-feather type="edit" />
              </button>
              <button class="action-button delete" @click="deleteArticleIso(record)">
                <vue-feather type="trash-2" />
              </button>
            </td>
          </template>
        </template>
      </DataTable>
    </div>
  </div>
  <!-- Create modal -->
  <CreateArticleIso v-if="showCreateModal" />
  <!-- Update modal -->
  <UpdateArticleIso v-if="showUpdateModal" />
  <!-- Delte Alert -->
  <DeleteAlert
    v-if="showDeleteModal"
    v-model:toggle="showDeleteModal"
    model="article-iso"
    :id="storeIso.currentArticleIso.id"
    :update-data="() => articleStore.getArticleById(articleStore.articleId)"
  />
</template>
