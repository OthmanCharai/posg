<script setup lang="ts">
import { useAxios, route } from '@/src/utils/axios-helper';
import type { Users } from '@common/types/users';
import type { PaginationMetadata } from '@common/types/global/pagination';
import { extractPaginatorObject } from '@utils/pagination';
import { lengthSorter } from '@/src/composables/table-sorters';

const { request, response, loading } = useAxios();

const usersData = ref<Users[]>([]);
const pagination = ref<PaginationMetadata>();
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

const getUsersList = async (page: number = 1) => {
  await request({
    method: 'GET',
    url: route('users.index', `page=${page}`)
  })

  if (response.value && response.value.data) {
    usersData.value = response.value.data.users.data;
    pagination.value = extractPaginatorObject(response.value.data.users);
  }
}

onMounted(async () => {
  await getUsersList();
})
</script>

<template>
  <PageHeader title="Utilisateurs">
    <div class="page-btn">
      <a
        href="javascript:void(0);"
        class="btn btn-added color"
        data-bs-toggle="modal"
        data-bs-target="#view-notes"
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
        :data="usersData"
        :current-page="pagination?.current_page"
        :total="pagination?.total"
        :fetched-data="getUsersList"
        :loading="loading"
      >
        <template #bodyCell="{column, record}">
          <template v-if="column.key === 'action'">
            <td class="action-table-data">
              <button class="action-button edit">
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
</template>
