<script setup lang="ts">
  import { lengthSorter } from '@/src/composables/table-sorters';
  import CreateUser from './CreateUser.vue';
  import UpdateUser from './UpdateUser.vue';
  import { useUserStore } from '@/src/stores/users.store';
  import type { Users } from '@common/types/users';

  const store = useUserStore();
  const columns = computed(() => [
    {
      title: 'Nom',
      dataIndex: 'first_name',
      sorter: lengthSorter('first_name'),
    },
    {
      title: 'Prenom',
      dataIndex: 'last_name',
      sorter: lengthSorter('last_name'),
    },
    {
      title: 'Email',
      dataIndex: 'email',
      sorter: lengthSorter('email'),
    },
    {
      title: 'Role',
      customRender: ({ record }) => {
        return record.role ? record.role.name : '-';
      },
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
  const editUser = (record: Users) => {
    store.setSelectedUserData(record);
    showUpdateModal.value = true;
  };

  // Delete user
  const showDeleteModal = ref<boolean>(false);
  const deleteUser = (record: Users) => {
    store.setSelectedUserData(record);
    showDeleteModal.value = true;
  };

  onMounted(async () => {
    await store.getUsersList();
  });
</script>

<template>
  <PageHeader title="Utilisateurs">
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
        :data="store.usersData"
        :current-page="store.pagination.current_page"
        :total="store.pagination.total"
        :fetched-data="store.getUsersList"
        :loading="store.loading"
      >
        <template #bodyCell="{ column, record }">
          <template v-if="column.key === 'action'">
            <td class="action-table-data">
              <button class="action-button edit" @click="editUser(record)">
                <vue-feather type="edit" />
              </button>
              <button class="action-button delete" @click="deleteUser(record)">
                <vue-feather type="trash-2" />
              </button>
            </td>
          </template>
        </template>
      </DataTable>
    </div>
  </div>
  <!-- Create user modal -->
  <CreateUser v-if="store.getResponse && showCreateModal" />
  <!-- Update user modal -->
  <UpdateUser v-if="store.getResponse && showUpdateModal" />
  <!-- Delte user Alert -->
  <DeleteAlert
    v-if="store.getResponse && showDeleteModal"
    v-model:toggle="showDeleteModal"
    model="users"
    :id="store.selectedUser.id"
    :update-data="() => store.getUsersList(store.pagination.current_page)"
  />
</template>
