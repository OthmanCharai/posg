<script setup lang="ts">
import { useAxios, route } from '@/src/utils/axios-helper';
import type { Users } from '@common/types/users';
import type { PaginationMetadata } from '@common/types/global/pagination';
import { extractPaginatorObject } from '@utils/pagination';
import { lengthSorter } from '@/src/composables/table-sorters';
import { SelectProps } from 'ant-design-vue/es/vc-select/Select';

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

const showModal = ref(false);
const data = ref({
  userName: '',
})

const options = ref<SelectProps['options']>([
  { value: 'jack', label: 'Jack' },
  { value: 'lucy', label: 'Lucy' },
  { value: 'tom', label: 'Tom' },
]);

const filterOption = (input: string, option: any) => {
  return option.value.toLowerCase().indexOf(input.toLowerCase()) >= 0;
};

const handleSubmission = () => {
  console.log('hello');
};

const fileList = ref([]);
const imgLoader = ref<boolean>(false);
const imageUrl = ref<string>('');

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
        @click="showModal = true"
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

  <ModalWrapper title="Nouveau utilisateur" v-model:open="showModal" @submit="handleSubmission" width="800px">
    <a-divider class="!text-xl">Données personnelles</a-divider>
    <section class="grid grid-cols-2 gap-4">
      <div class="grid gap-4">
        <a-form-item
          validate-status=""
          help=""
        >
          <a-input addonBefore="Nom d'utilisateur" v-model:value="data.userName" />
        </a-form-item>

        <a-form-item
          validate-status=""
          help=""
        >
          <a-input addonBefore="Mot de passe" v-model:value="data.userName" />
        </a-form-item>

        <a-form-item
          validate-status=""
          help=""
        >
          <a-input addonBefore="Nom" v-model:value="data.userName" />
        </a-form-item>

        <a-form-item
          validate-status=""
          help=""
        >
          <a-input addonBefore="Prenom" v-model:value="data.userName" />
        </a-form-item>
      </div>
      <div>
        <a-form-item
          validate-status=""
          help=""
        >
          <a-textarea placeholder="Address" class="h-[88px!important] mb-4" v-model:value="data.userName" />
        </a-form-item>

        <a-form-item
          validate-status=""
          help=""
        >
          <a-input addonBefore="Tel" v-model:value="data.userName" />
        </a-form-item>
      </div>
    </section>
    <section class="middle-section">
      <a-divider class="!text-xl">Roles</a-divider>
      <a-select
        v-model:value="data.userName"
        show-search
        style="width: 100%"
        placeholder="Select a person"
        :options="options"
        :filter-option="filterOption"
      ></a-select>
    </section>
    <section class="last-section">
      <a-divider class="!text-xl">Image</a-divider>
      <a-upload
        v-model:file-list="fileList"
        name="avatar"
        list-type="picture-card"
        class="avatar-uploader"
        :show-upload-list="false"
      >
        <img v-if="imageUrl" :src="imageUrl" alt="avatar" />
        <div v-else>
          <loading-outlined v-if="imgLoader"></loading-outlined>
          <plus-outlined v-else></plus-outlined>
          <div class="ant-upload-text">Upload</div>
        </div>
      </a-upload>
    </section>
  </ModalWrapper>
</template>
