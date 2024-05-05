<script setup lang="ts">
  import { useRoleStore } from '@/src/stores/roles.store';
  import { dropDownFilter } from '@/src/composables/filters';
  import { clearError, getErrorMessage, isError } from '@/src/utils/error-handler';
  import type { Permissions, Roles } from '@common/types/global/roles';

  const store = useRoleStore();
  const showUpdateModal = inject('showUpdateModal') as Ref<boolean>;

  const data = ref<Roles>({
    id: store.currentRole.id,
    description: store.currentRole.description,
    permissions: store.currentRole.permissions,
    name: store.currentRole.name,
  });

  const currentPermissions = (permissions: Permissions[], role: Roles) => {
    // Deep copy the permissions object
    const myPermissions = JSON.parse(JSON.stringify(permissions));
    return myPermissions.filter(
      (permission) =>
        (role.permissions & permission.value) === parseInt(permission.value),
    ); // to be improved later
  };

  // Submit data
  const handleSubmission = async () => {
    if (
      Array.isArray(data.value.permissions) &&
      data.value.permissions.every((item) => typeof item === 'object' && item !== null)
    ) {
      data.value.permissions = data.value.permissions?.map((item) => item.value);
    }
    await store.updateRole(data.value, showUpdateModal);
  };

  const checkIfSuper = (value: any) => {
    clearError('permissions');
    const hasSuper = value.includes('1');

    if (hasSuper && value.length > 1) {
      data.value.permissions = [];
    }
  };

  onMounted(() => {
    data.value.permissions = currentPermissions(store.permissions, store.currentRole);
  });
</script>

<template>
  <ModalWrapper
    title="Nouveau role"
    v-model:open="showUpdateModal"
    @submit="handleSubmission"
    width="800px"
  >
    <a-divider class="!text-xl">
      Données du role
    </a-divider>
    <section class="grid grid-cols-2 gap-4">
      <div class="grid gap-4">
        <a-form-item :validate-status="isError('name')" :help="getErrorMessage('name')">
          <a-input
            type="text"
            addonBefore="Nome"
            v-model:value="data.name"
            @change="clearError('name')"
          />
        </a-form-item>
      </div>
      <div>
        <a-form-item>
          <a-textarea
            placeholder="Description"
            class="h-[88px!important] mb-4"
            v-model:value="data.description"
          />
        </a-form-item>
      </div>
    </section>
    <div class="grid grid-cols-1 gap-4">
      <section class="middle-section">
        <a-divider class="!text-xl">
          Permissions
        </a-divider>
        <a-form-item
          :validate-status="isError('permissions')"
          :help="getErrorMessage('permissions')"
        >
          <a-select
            v-model:value="data.permissions"
            show-search
            style="width: 100%"
            placeholder="Permissions"
            mode="multiple"
            :max-tag-count="10"
            :options="store.permissions"
            :filter-option="dropDownFilter"
            @change="checkIfSuper"
          />
        </a-form-item>
      </section>
    </div>
  </ModalWrapper>
  <Loader :is-active="store.loading" />
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
