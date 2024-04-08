<script setup lang="ts">
import { useAxios, route } from '@/src/utils/axios-helper';
import type { Users } from '@common/types/users';
import type { PaginationMetadata } from '@common/types/global/pagination';
import { extractPaginatorObject } from '@utils/pagination';
import { createLengthBasedSorter } from '../../../composable/table-sorters';

const { request, response } = useAxios();

const usersData = ref<Users[]>([]);
const pagination = ref<PaginationMetadata>();
const columns = [
  {
    title: "Nome",
    dataIndex: "first_name",
    sorter: createLengthBasedSorter(usersData.value, 'first_name')
  },
  {
    title: "Prenom",
    dataIndex: "last_name",
    sorter: createLengthBasedSorter(usersData.value, 'last_name')
  },
  {
    title: "Email",
    dataIndex: "email",
    sorter: createLengthBasedSorter(usersData.value, 'email')
  },
  {
    title: "Role",
    customRender: ({ record }) => {
      return record.role ? record.role.name : 'N/A';
    }
  },
];

const getUsersList = async () => {
  await request({
    method: 'GET',
    url: route('users.index')
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
      <DataTable :columns="columns" :data="usersData"/>
    </div>
  </div>
</template>
