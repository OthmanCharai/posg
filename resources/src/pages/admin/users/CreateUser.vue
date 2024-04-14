<script setup lang="ts">
import type { Users } from '@common/types/users';
import { SelectProps } from 'ant-design-vue/es/vc-select/Select';
import { useUsers } from '@/src/stores/users';
import { deepClone } from '@/src/utils/object';
import type { Roles } from '@/src/common/types/global/roles';
import { dropDownFilter } from '@/src/composables/filters';
import { useAxios, route } from '@utils/axios-helper';
import { clearError, getErrorMessage, isError } from "@/src/utils/error-handler";
import { Toast } from "@utils/toast";
import { PlusOutlined } from '@ant-design/icons-vue';
import type { UploadProps } from 'ant-design-vue';

const { request, response } = useAxios();
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
  role_id: ''
})

// Submit data
const handleSubmission = async () => {
  await request({
        method: 'POST',
        url: route('users.create.submit'),
        data: data.value
      })

  if (response.value) {
    Toast.success('Votre compte a été crée avec succès.');
  }
};

// upload image
const fileList = ref<UploadProps['fileList']>([]);

const beforeUpload = (file: UploadProps['fileList'][number]) => {
  return false; // This stops the upload request of antdv
}
</script>

<template>
  <ModalWrapper title="Nouveau utilisateur" v-model:open="showModal" @submit="handleSubmission" width="800px">
    <a-divider class="!text-xl">Données personnelles</a-divider>
    <section class="grid grid-cols-2 gap-4">
      <div class="grid gap-4">
        <a-form-item
          :validate-status="isError('email')"
          :help="getErrorMessage('email')"
        >
          <a-input type="email" addonBefore="Email" v-model:value="data.email" @change="clearError('email')" />
        </a-form-item>
        <a-form-item
          :validate-status="isError('password')"
          :help="getErrorMessage('password')"
        >
          <a-input-password addonBefore="Mot de passe" v-model:value="data.password" @change="clearError('password')"/>
        </a-form-item>
        <a-form-item
          :validate-status="isError('first_name')"
          :help="getErrorMessage('first_name')"
        >
          <a-input addonBefore="Nom" v-model:value="data.first_name"  @change="clearError('first_name')" />
        </a-form-item>
        <a-form-item
          :validate-status="isError('last_name')"
          :help="getErrorMessage('last_name')"
        >
          <a-input addonBefore="Prenom" v-model:value="data.last_name"  @change="clearError('last_name')"/>
        </a-form-item>
      </div>
      <div>
        <a-form-item>
          <a-textarea placeholder="Address" class="h-[88px!important] mb-4" v-model:value="data.address"/>
        </a-form-item>
        <a-form-item>
          <a-input type="number" addonBefore="Tel" v-model:value="data.phone_number"/>
        </a-form-item>
      </div>
    </section>
    <div class="grid grid-cols-2 gap-4">
      <section class="middle-section">
        <a-divider class="!text-xl">Roles</a-divider>
        <a-form-item
          :validate-status="isError('role_id')"
          :help="getErrorMessage('role_id')"
        >
        <a-select
          v-model:value="data.role_id"
          show-search
          style="width: 100%;"
          placeholder="Role"
          :options="rolesList"
          :filter-option="dropDownFilter"
          @change="clearError('role_id')"
        ></a-select>
        </a-form-item>
      </section>
      <section class="last-section">
        <a-divider class="!text-xl">Image</a-divider>
        <div class="flex justify-center">
          <a-upload
            v-model:file-list="fileList"
            name="avatar"
            list-type="picture-card"
            class="upload-list-inline"
            :before-upload="beforeUpload"
          >
            <div v-if="fileList && fileList.length < 1">
              <plus-outlined></plus-outlined>
              <div class="ant-upload-text">Upload</div>
            </div>
          </a-upload>
        </div>
      </section>
    </div>
  </ModalWrapper>
</template>

<style scoped>
.upload-list-inline {
  display: flex;
  max-width: max-content;
}
.upload-list-inline :deep(.ant-upload-list-item-actions) {
  display: flex;
  justify-content: center;
  align-items: center;
}
.upload-list-inline :deep(.ant-upload-list-item-actions a) {
  display: none !important;
}
</style>
