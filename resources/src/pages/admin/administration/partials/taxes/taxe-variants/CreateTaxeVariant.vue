<script setup lang="ts">
import type { TaxeVariants } from '@common/types/taxes';
import { useTaxeStore } from '@/src/stores/taxes.store';
import { clearError, getErrorMessage, isError } from "@/src/utils/error-handler";

const store = useTaxeStore();
const showCreateModal = inject('showCreateTaxeVariantModal') as Ref<boolean>;

const data = ref<TaxeVariants>({
  name: '',
  value: '',
  type: 0,
});

// Submit data
const handleSubmission = async () => {
  await store.createTaxeVariant(data.value, showCreateModal);
};
</script>

<template>
  <ModalWrapper title="Ajouter taxe" v-model:open="showCreateModal" @submit="handleSubmission" width="400px">
    <section class="w-full border-t border-gray-100 py-8 grid gap-3">
      <a-form-item
        :validate-status="isError('name')"
        :help="getErrorMessage('name')"
      >
        <a-input addonBefore="Nom du taxe" v-model:value="data.name"  @change="clearError('name')" />
      </a-form-item>
      <a-form-item
        :validate-status="isError('value')"
        :help="getErrorMessage('value')"
      >
        <a-input-number
          type="number"
          v-model:value="data.value"
          addon-before="Valeur"
          :addon-after="data.type === 0 ? '%' : '$'"
          @change="clearError('value')"
          :controls="false"
          style="width: 100%"
        >
        </a-input-number>
      </a-form-item>
    </section>
    <div class="flex justify-center">
      <a-radio-group v-model:value="data.type" button-style="solid">
        <a-radio-button :value="0">
          <vue-feather type="percent" class="mt-1"></vue-feather>
        </a-radio-button>
        <a-radio-button :value="1">
          <vue-feather type="dollar-sign" class="mt-1"></vue-feather>
        </a-radio-button>
      </a-radio-group>
    </div>
  </ModalWrapper>
  <Loader :is-active="store.loading"/>
</template>
