<script setup lang="ts">
import {clearError, getErrorMessage, isError} from "@/src/utils/error-handler";
import {Depot} from "@common/types/global/depot";
import {useDepotStore} from "@stores/depot.store";

const store = useDepotStore();
const showCreateModal = inject('showCreateModal') as Ref<boolean>;

const data = ref<Depot>({
  name: '',
  address: ''
});

// Submit data
const handleSubmission = async () => {
  await store.create(data.value, showCreateModal);
};
</script>

<template>
  <ModalWrapper title="Nouveau Article category" v-model:open="showCreateModal" @submit="handleSubmission"
                width="800px">
    <section class="grid grid-cols-2 gap-4">
      <div class="grid gap-4">
        <a-form-item
            :validate-status="isError('name')"
            :help="getErrorMessage('name')"
        >
          <a-input type="text" addonBefore="Nome" v-model:value="data.name" @change="clearError('name')"/>
        </a-form-item>
      </div>
      <div class="grid gap-4">
        <a-form-item
            :validate-status="isError('address')"
            :help="getErrorMessage('address')"
        >
          <a-input type="text" addonBefore="Address" v-model:value="data.address" @change="clearError('address')"/>
        </a-form-item>
      </div>
    </section>
  </ModalWrapper>
  <Loader :is-active="store.loading"/>
</template>
