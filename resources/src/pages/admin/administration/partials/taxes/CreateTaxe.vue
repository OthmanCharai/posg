<script setup lang="ts">
  import type { Taxes } from '@common/types/taxes';
  import { useTaxeStore } from '@/src/stores/taxes.store';
  import { clearError, getErrorMessage, isError } from '@/src/utils/error-handler';

  const store = useTaxeStore();
  const showCreateModal = inject('showCreateTaxeModal') as Ref<boolean>;

  const data = ref<Taxes>({
    name: '',
  });

  // Submit data
  const handleSubmission = async () => {
    await store.createTaxe(data.value, showCreateModal);
  };
</script>

<template>
  <ModalWrapper
    title="Nouvelle taxe"
    v-model:open="showCreateModal"
    @submit="handleSubmission"
    width="400px"
  >
    <section class="w-full border-t border-gray-100 py-8">
      <a-form-item :validate-status="isError('name')" :help="getErrorMessage('name')">
        <a-input
          addonBefore="Nom du taxe"
          v-model:value="data.name"
          @change="clearError('name')"
        />
      </a-form-item>
    </section>
  </ModalWrapper>
  <Loader :is-active="store.loading" />
</template>
