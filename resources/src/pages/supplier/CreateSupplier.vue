<script setup lang="ts">
import {clearError, getErrorMessage, isError} from "@/src/utils/error-handler";
import {useSupplierStore} from "@stores/supplier.store";
import {Supplier} from "@common/types/global/supplier";

const store = useSupplierStore();
const showCreateModal = inject('showCreateModal') as Ref<boolean>;

const data = ref<Supplier>({
  first_name: '',
  last_name: '',
  email: '',
  phone_number: '',
  address: '',
  company_name: '',
  account_number: '',
  vat_number: '',
});

// Submit data
const handleSubmission = async () => {
  await store.create(data, showCreateModal);
};
</script>

<template>
  <ModalWrapper title="Nouveau utilisateur" v-model:open="showCreateModal" @submit="handleSubmission" width="800px">
    <a-divider class="!text-xl">Données personnelles</a-divider>
    <section class="grid grid-cols-2 gap-4">
      <div class="grid gap-4">
        <a-form-item
            :validate-status="isError('email')"
            :help="getErrorMessage('email')"
        >
          <a-input type="email" addonBefore="Email" v-model:value="data.email" @change="clearError('email')"/>
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
          <a-input addonBefore="Nom" v-model:value="data.first_name" @change="clearError('first_name')"/>
        </a-form-item>
        <a-form-item
            :validate-status="isError('last_name')"
            :help="getErrorMessage('last_name')"
        >
          <a-input addonBefore="Prenom" v-model:value="data.last_name" @change="clearError('last_name')"/>
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
              :before-upload="stopAntdvDefaultRequest"
              accept="image/png, image/jpeg"
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
