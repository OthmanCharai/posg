<script setup lang="ts">
  import type { ArticleInfo } from '@/src/common/types/articles';
  import { lengthSorter } from '@/src/composables/table-sorters';
  import { useArticlesStore } from '@stores/articles.store';
  import { useRouter } from 'vue-router';

  const store = useArticlesStore();
  const router = useRouter();
  const columns = computed(() => [
    {
      title: 'Image',
      dataIndex: 'image',
    },
    {
      title: 'Code Bare',
      dataIndex: 'code_bare',
      sorter: lengthSorter('code_bare'),
    },
    {
      title: 'Nom Article',
      dataIndex: 'name',
      sorter: lengthSorter('name'),
    },
    {
      title: 'Emplacement Article',
      dataIndex: 'emplacement',
      sorter: lengthSorter('emplacement'),
    },
    {
      title: 'Prix Gros',
      dataIndex: 'wholesale_price',
      sorter: lengthSorter('wholesale_price'),
    },
    {
      title: 'Prix Détail',
      dataIndex: 'retail_price',
      sorter: lengthSorter('retail_price'),
    },
    {
      title: 'Dérnier Prix De vente',
      dataIndex: 'last_sale_price',
      sorter: lengthSorter('last_sale_price'),
    },
    {
      title: 'Quantité Disponible',
    },
    {
      title: 'Actions',
      key: 'action',
    },
  ]);

  // Edit article
  const editArticle = (record: ArticleInfo) => {
    if(!record) {
      return;
    }

    console.log(record);
    store.setSelectedArticle(record);
    router.push({ name: 'articlePanel' });
  };

  // Delete article
  const showDeleteModal = ref<boolean>(false);
  const deleteArticle = (record: ArticleInfo) => {
    if(!record) {
      return;
    }
    store.setSelectedArticle(record);
    showDeleteModal.value = true;
  };

  onMounted(async () => {
    await store.get();
  });
</script>

<template>
  <PageHeader title="Articles">
    <router-link :to="{ name: 'articlePanel' }">
      <a-button type="primary">
        <vue-feather :size="16" type="plus-circle" />
        <span>Nouveau article</span>
      </a-button>
    </router-link>
  </PageHeader>

  <div class="card table-list-card">
    <Filter />
    <div class="card-body">
      <DataTable
        :columns="columns"
        :data="store.articlesData"
        :current-page="store.pagination.current_page"
        :total="store.pagination.total"
        :fetched-data="() => store.get()"
        :loading="store.loading"
      >
        <template #bodyCell="{column, record}">
          <template v-if="column.dataIndex === 'image'">
            <img
              :src="record.image"
              alt="Image de l'article"
              class="w-[100px] h-[70px] object-cover rounded-md"
            >
          </template>

          <template v-if="column.key === 'action'">
            <td class="action-table-data">
              <button class="action-button edit" @click="editArticle(record)">
                <vue-feather type="edit" />
              </button>
              <button class="action-button delete" @click="deleteArticle(record)">
                <vue-feather type="trash-2" />
              </button>
            </td>
          </template>
        </template>
      </DataTable>
    </div>
  </div>
  <DeleteAlert
    v-if="store.getResponse && showDeleteModal"
    v-model:toggle="showDeleteModal"
    model="articles"
    :id="store.selectedArticle.id"
    :update-data="() => store.get(store.pagination.current_page)"
  />
</template>
