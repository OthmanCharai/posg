<script setup lang="ts">
import type { Users } from '@common/types/users';
import { SelectProps } from 'ant-design-vue/es/vc-select/Select';
import { useUsers } from '@/src/stores/users';
import { deepClone } from '@/src/utils/object';
import type { Roles } from '@/src/common/types/global/roles';
import { dropDownFilter } from '@/src/composables/filters';

const store = useUsers();
const roles = ref<Roles[]>([]);
const rolesList = ref<SelectProps['options']>([]);
const showModal = inject('showCreateModal') as Ref<boolean>;

watchEffect(() => {
  roles.value = deepClone(store.roles);
  if (roles.value.length > 0) {
    rolesList.value = roles.value.map(role => ({
      label: role.name,
      value: role.id
    }));
  }
});

const data = ref<Users>({
  first_name: '',
  last_name: '',
  email: '',
  password: '',
  phone_number: '',
  address: '',
  logo: '',
  role: {
    id: '',
  }
})

// Submit data
const handleSubmission = () => {
  console.log('hello');
};

// upload image
const fileList = ref([]);
const imgLoader = ref<boolean>(false);
const imageUrl = ref<string>('');
</script>

<template>
  <ModalWrapper title="Nouveau utilisateur" v-model:open="showModal" @submit="handleSubmission" width="800px">
    <a-divider class="!text-xl">Données personnelles</a-divider>
    <section class="grid grid-cols-2 gap-4">
      <div class="grid gap-4">
        <a-form-item
          validate-status=""
          help=""
        >
          <a-input addonBefore="Email" v-model:value="data.email" />
        </a-form-item>

        <a-form-item
          validate-status=""
          help=""
        >
          <a-input addonBefore="Mot de passe" v-model:value="data.password" />
        </a-form-item>

        <a-form-item
          validate-status=""
          help=""
        >
          <a-input addonBefore="Nom" v-model:value="data.first_name" />
        </a-form-item>

        <a-form-item
          validate-status=""
          help=""
        >
          <a-input addonBefore="Prenom" v-model:value="data.last_name" />
        </a-form-item>
      </div>
      <div>
        <a-form-item
          validate-status=""
          help=""
        >
          <a-textarea placeholder="Address" class="h-[88px!important] mb-4" v-model:value="data.address" />
        </a-form-item>

        <a-form-item
          validate-status=""
          help=""
        >
          <a-input addonBefore="Tel" v-model:value="data.phone_number" />
        </a-form-item>
      </div>
    </section>
    <div class="grid grid-cols-2 gap-4">
      <section class="middle-section">
        <a-divider class="!text-xl">Roles</a-divider>
        <a-select
          v-model:value="data.role.id"
          show-search
          style="width: 100%;"
          placeholder="Role"
          :options="rolesList"
          :filter-option="dropDownFilter"
        ></a-select>
      </section>
      <section class="last-section">
        <a-divider class="!text-xl">Image</a-divider>
        <div class="flex justify-center">
          <a-upload
          v-model:file-list="fileList"
          name="avatar"
          list-type="picture-card"
          class="avatar-uploader max-w-max"
          :show-upload-list="false"
        >
          <img v-if="imageUrl" :src="imageUrl" alt="avatar" />
          <div v-else>
            <div class="ant-upload-text">Upload</div>
          </div>
        </a-upload>
        </div>
      </section>
    </div>
  </ModalWrapper>
</template>

<style scoped>
  :deep(.ant-select-selector) {
    padding-top: 0 !important;
    padding-bottom: 0 !important;
  }
</style>
