<script setup lang="ts">
import { lengthSorter } from '@/src/composables/table-sorters';
import CreateUser from './CreateUser.vue';
import UpdateUser from './UpdateUser.vue';
import { useUsers } from '@/src/stores/users';

const store = useUsers();
const columns = computed(() => [
  {
    title: "Nome",
    dataIndex: "first_name",
    sorter: lengthSorter('first_name'),
  },
  {
    title: "Prenom",
    dataIndex: "last_name",
    sorter: lengthSorter('last_name'),
  },
  {
    title: "Email",
    dataIndex: "email",
    sorter: lengthSorter('email'),
  },
  {
    title: "Role",
    customRender: ({ record }) => {
      return record.role ? record.role.name : '-';
    }
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

const editUser = (record) => {
  store.setCurrentUserData(record);
  showUpdateModal.value = true;
}

onMounted(async () => {
  await store.getUsersList();
})
</script>

<template>
  <PageHeader title="Utilisateurs">
    <div class="page-btn">
      <a
        href="javascript:void(0);"
        class="btn btn-added color"
        @click="showCreateModal = true"
        >
        <vue-feather type="plus-circle" class="me-2"></vue-feather>
        Ajouter
      </a>
    </div>
  </PageHeader>

  <div class="card table-list-card">
    <Filter />
    <div class="card-body">
      <DataTable
        :columns="columns"
        :data="store.usersData"
        :current-page="store.pagination.current_page"
        :total="store.pagination.total"
        :fetched-data="store.getUsersList"
        :loading="store.loading"
      >
        <template #bodyCell="{column, record}">
          <template v-if="column.key === 'action'">
            <td class="action-table-data">
              <button class="action-button edit" @click="editUser(record)">
                <vue-feather type="edit"></vue-feather>
              </button>
              <button class="action-button delete">
                <vue-feather type="trash-2"></vue-feather>
              </button>
            </td>
          </template>
        </template>
      </DataTable>
    </div>
  </div>

  <CreateUser v-if="store.getResponse && showCreateModal" />
  <UpdateUser v-if="store.getResponse && showUpdateModal" />
</template>
