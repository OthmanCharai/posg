<script setup lang="ts">
import {useRoleStore} from "@/src/stores/roles";
import {useAxios} from '@utils/axios-helper';
import {clearError, getErrorMessage, isError} from "@/src/utils/error-handler";
import {dropDownFilter} from "@/src/composables/filters";
import {Ref} from "vue";
import {Roles} from "@common/types/global/roles";

const store = useRoleStore();
const {request, response, loading} = useAxios();
const showCreateModal = inject('showCreateModal') as Ref<boolean>;

const data = ref<Roles>({
  id: '',
  description: '',
  permissions: [],
  name: ''
})

// Submit data
const handleSubmission = async () => {
  await store.createRole(data.value);
  if (store.status === 201) {
    showCreateModal.value = false;
  }
};
const checkIfSupper = (value: any) => {
  clearError('permissions');
  const hasSuper = value.includes('1');

  if (hasSuper && value.length > 1) {
    data.value.permissions = [];
  }
}
</script>

<template>
  <ModalWrapper title="Nouveau role" v-model:open="showCreateModal as boolean" @submit="handleSubmission" width="800px">
    <a-divider class="!text-xl">Données du role</a-divider>
    <section class="grid grid-cols-2 gap-4">
      <div class="grid gap-4">
        <a-form-item
            :validate-status="isError('name')"
            :help="getErrorMessage('name')"
        >
          <a-input type="text" addonBefore="Nome" v-model:value="data.name" @change="clearError('name')"/>
        </a-form-item>
        <a-form-item
            :validate-status="isError('permissions')"
            :help="getErrorMessage('permissions')"
        >
          <a-select
              v-model:value="data.permissions"
              show-search
              style="width: 100%;"
              mode="multiple"
              :max-tag-count="10"
              placeholder="Permissions"
              :options="store.permissions"
              :filter-option="dropDownFilter"
              @change="checkIfSupper "
          ></a-select>
        </a-form-item>
      </div>
    </section>
    <div class="grid grid-cols-1 gap-4">
      <div>
        <a-form-item>
          <a-textarea placeholder="Description" class="h-[88px!important] mb-4" v-model:value="data.description"/>
        </a-form-item>
      </div>
    </div>
  </ModalWrapper>
  <Loader :is-active="loading"/>
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
