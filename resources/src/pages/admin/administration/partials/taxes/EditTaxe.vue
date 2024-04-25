<script setup lang="ts">
import type { Taxes } from '@common/types/taxes';
import { useTaxeStore } from '@/src/stores/taxes.store';
import { clearError, getErrorMessage, isError } from "@/src/utils/error-handler";

const store = useTaxeStore();
const showEditModal = inject('showUpdateTaxeModal') as Ref<boolean>;
const selectedTaxe = ref<Taxes>(store.selectedTaxe);

const data = ref<Taxes>({
  name: selectedTaxe.value.name,
});

// Submit data
const handleSubmission = async () => {
  await store.updateTaxe(data.value, showEditModal);
};
</script>

<template>
  <ModalWrapper title="Modifié la taxe" v-model:open="showEditModal" @submit="handleSubmission" width="400px">
    <section class="w-full border-t border-gray-100 py-8">
      <a-form-item
        :validate-status="isError('name')"
        :help="getErrorMessage('name')"
      >
        <a-input addonBefore="Nom du taxe" v-model:value="data.name"  @change="clearError('name')" />
      </a-form-item>
    </section>
  </ModalWrapper>
  <Loader :is-active="store.loading"/>
</template>
