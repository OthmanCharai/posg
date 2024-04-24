<script setup lang="ts">
import {useAxios} from '@utils/axios-helper';
import {clearError, getErrorMessage, isError} from "@/src/utils/error-handler";
import {Toast} from "@utils/toast";
import {useBankAccountStore} from "@stores/bankAccount.store";
import {BankAccount} from "@common/types/global/bankAccount";

const store = useBankAccountStore();
const {response, loading} = useAxios();
const showCreateModal = inject('showCreateModal') as Ref<boolean>;

const data = ref<BankAccount>({
  bank_name: '',
  account_number: '',
  balance: '',
  account_holder_name: '',
  account_holder_phone: '',
  account_holder_email: ''
});

// Submit data
const handleSubmission = async () => {
  await store.create(data.value);
  if (response.value) {
    Toast.success('Votre banque a été crée avec succès.');
    showCreateModal.value = false;
  }
};
</script>

<template>
  <ModalWrapper title="Nouveau utilisateur" v-model:open="showCreateModal" @submit="handleSubmission" width="800px">
    <a-divider class="!text-xl">Données du Banque</a-divider>
    <section class="grid grid-cols-2 gap-4">
      <div class="grid gap-4">
        <a-form-item
            :validate-status="isError('bank_name')"
            :help="getErrorMessage('bank_name')"
        >
          <a-input type="text" addonBefore="Nom de la banque" v-model:value="data.bank_name"
                   @change="clearError('bank_name')"/>
        </a-form-item>
        <a-form-item
            :validate-status="isError('account_number')"
            :help="getErrorMessage('account_number')"
        >
          <a-input type="text" addonBefore="Numéro de compte" v-model:value="data.account_number"
                   @change="clearError('account_number')"/>
        </a-form-item>
        <a-form-item
            :validate-status="isError('balance')"
            :help="getErrorMessage('balance')"
        >
          <a-input type="number" addonBefore="Solde" v-model:value="data.balance" @change="clearError('balance')"/>
        </a-form-item>
        <a-form-item
            :validate-status="isError('account_holder_name')"
            :help="getErrorMessage('account_holder_name')"
        >
          <a-input addonBefore="Nom du titulaire" v-model:value="data.account_holder_name"
                   @change="clearError('account_holder_name')"/>
        </a-form-item>
      </div>
      <div>
        <a-form-item :validate-status="isError('account_holder_phone')"
                     :help="getErrorMessage('account_holder_phone')">
          <a-input type="number" addonBefore="Tel" v-model:value="data.account_holder_phone"
                   @change="clearError('account_holder_phone')"/>
        </a-form-item>

        <a-form-item :validate-status="isError('account_holder_email')"
                     :help="getErrorMessage('account_holder_email')">
          <a-input type="email" addonBefore="Email" v-model:value="data.account_holder_email"
                   @change="clearError('account_holder_email')"/>
        </a-form-item>
      </div>
    </section>
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
