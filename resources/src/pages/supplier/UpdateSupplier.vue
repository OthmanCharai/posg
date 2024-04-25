<script setup lang="ts">
import {clearError, getErrorMessage, isError} from "@/src/utils/error-handler";
import {useSupplierStore} from "@stores/supplier.store";
import {Supplier} from "@common/types/global/supplier";

const store = useSupplierStore();
const showUpdateModal = inject('showUpdateModal') as Ref<boolean>;

const data = ref<Supplier>({
  first_name: store.currentSupplier.first_name,
  last_name: store.currentSupplier.last_name,
  email: store.currentSupplier.email,
  phone_number: store.currentSupplier.phone_number,
  address: store.currentSupplier.address,
  company_name: store.currentSupplier.company_name,
  account_number: store.currentSupplier.account_number,
  vat_number: store.currentSupplier.vat_number,
});

// Submit data
const handleSubmission = async () => {
  await store.update(store.currentSupplier, data.value, showUpdateModal);
};
</script>

<template>
  <ModalWrapper title="Nouveau Fournisseurs" v-model:open="showUpdateModal " @submit="handleSubmission"
                width="800px">
    <a-divider class="!text-xl">Informations de contact</a-divider>
    <section class="grid grid-cols-2 gap-4">
      <div class="grid gap-4">
        <a-form-item
            :validate-status="isError('email')"
            :help="getErrorMessage('email')"
        >
          <a-input type="email" addonBefore="Email" v-model:value="data.email" @change="clearError('email')"/>
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
    <div class="grid grid-cols-1 gap-4">
      <section class="middle-section">
        <a-divider class="!text-xl">Details</a-divider>
        <div class="grid gap-4">
          <a-form-item
              :validate-status="isError('company_name')"
              :help="getErrorMessage('company_name')"
          >
            <a-input type="text" addonBefore="Nom Socété" v-model:value="data.company_name"/>
          </a-form-item>
          <a-form-item
              :validate-status="isError('vat_number')"
              :help="getErrorMessage('vat_number')"
          >
            <a-input type="text" addonBefore="TVA" v-model:value="data.vat_number"/>
          </a-form-item>

          <a-form-item
              :validate-status="isError('account_number')"
              :help="getErrorMessage('account_number')"
          >
            <a-input type="text" addonBefore="Numero de compte" v-model:value="data.account_number"/>
          </a-form-item>
        </div>
      </section>
    </div>
  </ModalWrapper>
  <Loader :is-active="store.loading"/>
</template>

<style scoped>
</style>
