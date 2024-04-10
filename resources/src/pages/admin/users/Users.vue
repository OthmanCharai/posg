<script setup lang="ts">
import { useAxios, route } from '@/src/utils/axios-helper';
import type { Users } from '@common/types/users';
import type { PaginationMetadata } from '@common/types/global/pagination';
import { extractPaginatorObject } from '@utils/pagination';
import { lengthSorter } from '@/src/composables/table-sorters';
import { Modal } from 'ant-design-vue';

const { request, response, loading } = useAxios();
const showModal = ref(false);
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
        class="btn btn-added color"
        @click="showModal= !showModal"
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

  <Modal v-model:open="showModal" title="hello test test" :zIndex="1010">
    <div class="border-top border-dark-subtle pt-3">
    <div>
      Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestias rerum amet est incidunt asperiores!
      Corrupti velit commodi deleniti optio quas non excepturi voluptates debitis,
      vitae quia reprehenderit delectus minus sed.
    </div>
    </div>
    <template #footer>
      <div class="pt-3 d-flex justify-content-end gap-2 border-top border-dark-subtle">
        <button
          type="button"
          class="btn btn-primary"
        >
          <vue-feather :size="16" type="save"></vue-feather>
          <span>Enregister</span>
        </button>
        <button
          type="button"
          class="btn btn-light"
          @click="showModal = false"
        >
          <vue-feather :size="16" type="x-octagon"></vue-feather>
          <span>Annuler</span>
        </button>
      </div>
    </template>
  </Modal>
</template>
