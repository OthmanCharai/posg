<script setup lang="ts">
import { lengthSorter } from '@/src/composables/table-sorters';

// const store = ;
const columns = computed(() => [
  {
    title: "Code Bare",
    dataIndex: "first_name",
    sorter: lengthSorter('first_name'),
  },
  {
    title: "Nom Article",
    dataIndex: "last_name",
    sorter: lengthSorter('last_name'),
  },
  {
    title: "Emplacement Article",
    dataIndex: "email",
    sorter: lengthSorter('email'),
  },
  {
    title: "Prix Gros",
    dataIndex: "email",
    sorter: lengthSorter('email'),
  },
  {
    title: "Prix Détail",
    dataIndex: "email",
    sorter: lengthSorter('email'),
  },
  {
    title: "Dérnier Prix De vente",
    dataIndex: "email",
    sorter: lengthSorter('email'),
  },
  {
    title: "Quantité Disponible",
    dataIndex: "email",
    sorter: lengthSorter('email'),
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
  // await store.getUsersList();
})
</script>

<template>
  <PageHeader title="Articles">
    <router-link :to="{ name: 'articlePanel' }">
      <a-button type="primary">
        <vue-feather :size="16" type="plus-circle"></vue-feather>
        <span>Nouveau article</span>
      </a-button>
    </router-link>
  </PageHeader>

  <div class="card table-list-card">
    <Filter/>
    <div class="card-body">
      <DataTable
          :columns="columns"
          :data="[]"
          :current-page="1"
          :total="10"
          :fetched-data="() => []"
          :loading="false"
      >
        <template #bodyCell="{column, record}">
          <template v-if="column.key === 'action'">
            <td class="action-table-data">
              <router-link :to="{ name: 'articlePanel' }">
                <button class="action-button edit">
                  <vue-feather type="edit"></vue-feather>
                </button>
              </router-link>
              <button class="action-button delete">
                <vue-feather type="trash-2"></vue-feather>
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
