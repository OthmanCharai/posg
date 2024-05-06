<script setup lang="ts">
  import { lengthSorter } from '@/src/composables/table-sorters';
  import { useArticlesStore } from '@stores/articles.store';

  const store = useArticlesStore();
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

  // Edit user
  // const editUser = (record) => {
  //   store.setSelectedUserData(record);
  //   showUpdateModal.value = true;
  // }

  // Delete user
  // const showDeleteModal = ref<boolean>(false);
  // const deleteUser = (record: Users) => {
  //   store.setSelectedUserData(record);
  //   showDeleteModal.value = true;
  // }

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
              <router-link :to="{ name: 'articlePanel' }">
                <button class="action-button edit">
                  <vue-feather type="edit" />
                </button>
              </router-link>
              <button class="action-button delete">
                <vue-feather type="trash-2" />
              </button>
            </td>
          </template>
        </template>
      </DataTable>
    </div>
  </div>
  <!-- <DeleteAlert
      v-if="store.getResponse && showDeleteModal"
      v-model:toggle="showDeleteModal"
      model="articles"
      :id="store.selectedArticle.id"
      :update-data="() => store.getList(store.pagination.current_page)"
  /> -->
</template>
