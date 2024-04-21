<script setup lang="ts">
import type { Users } from '@common/types/users';
import { SelectProps } from 'ant-design-vue/es/vc-select/Select';
import { useUserStore } from '@/src/stores/users.store';
import { dropDownFilter } from '@/src/composables/filters';
import { clearError, getErrorMessage, isError } from "@/src/utils/error-handler";
import { PlusOutlined } from '@ant-design/icons-vue';
import type { UploadProps } from 'ant-design-vue';

const store = useUserStore();
const rolesList = ref<SelectProps['options']>([]);
const showUpdateModal = inject('showUpdateModal') as Ref<boolean>;
const selectedUser = ref<Users>(store.selectedUser);

rolesList.value = store.roles.map(role => ({
  label: role.name,
  value: role.id
}));

const data = ref<Users>({
  first_name: selectedUser.value?.first_name,
  last_name: selectedUser.value?.last_name,
  email: selectedUser.value?.email,
  password: selectedUser.value?.password,
  phone_number: selectedUser.value?.phone_number,
  address: selectedUser.value?.address,
  logo: selectedUser.value?.logo,
  role_id: selectedUser.value?.role.id,
});

// Submit data
const handleSubmission = async () => {
  if (fileList.value && fileList.value?.length > 0) {
    data.value.logo = fileList.value[0].originFileObj;
  }

  const formData = new FormData();

  Object.entries(data.value).forEach(([key, value]) => {
    if (key === "logo" && typeof value === "string") {
      return;
    } else {
      formData.append(key, value ?? "");
    }
  });

  await store.updateUser(formData, showUpdateModal);
};

// upload image
const fileList = ref<UploadProps['fileList']>([]);

const stopAntdvDefaultRequest = () => {
  return false;
}

const changeImage = () => {
  if (fileList.value && fileList.value.length > 0) {
    return data.value.logo = fileList.value[0].originFileObj;
  }
}

const removeImage = () => {
  if (data.value.logo) {
    data.value.logo = '';
    return true;
  }
}

onMounted(async() => {
  if(data.value.logo && fileList.value && fileList.value.length === 0) {
    const image: UploadProps['fileList'][number] = {
      uid: 'index-1',
      status: 'done',
      thumbUrl: data.value.logo as string,
    };

    fileList.value.push(image);
  }
})
</script>

<template>
  <ModalWrapper title="Utilisateur" v-model:open="showUpdateModal" @submit="handleSubmission" width="800px">
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
            accept="image/png, image/jpeg"
            :before-upload="stopAntdvDefaultRequest"
            @remove="removeImage"
            @change="changeImage"
            :maxCount="1"
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
  <Loader :is-active="store.loading"/>
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
