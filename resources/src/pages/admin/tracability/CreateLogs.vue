<script setup lang="ts">
import { clearError, getErrorMessage, isError } from '@/src/utils/error-handler';
import { dropDownFilter } from '@/src/composables/filters';
import {useLogStore} from "@stores/log.store";
import {AuditLog, CreateAuditLog} from "@common/types/global/log";


const store = useLogStore();
const showCreateModal = inject('showCreateModal') as Ref<boolean>;

const data = ref<CreateAuditLog>({
  user_id: '',
  table_name: '',
  log_type: '',
});

// Submit data
const handleSubmission = async () => {
  await store.create(data.value, showCreateModal);
};

</script>

<template>
  <ModalWrapper
      title="Nouvel Utilisateur Activité"
      v-model:open="showCreateModal"
      @submit="handleSubmission"
      width="800px"
  >
    <div class="grid grid-cols-3 gap-4">
      <section class="middle-section">
        <a-form-item
            :validate-status="isError('user_id')"
            :help="getErrorMessage('user_id')"
        >
          <a-select
              v-model:value="data.user_id"
              show-search
              style="width: 100%"
              placeholder="Utilisateur"
              :max-tag-count="10"
              :options="store.users"
              :filter-option="dropDownFilter"
          />
        </a-form-item>
      </section>
      <section class="middle-section">
        <a-form-item
            :validate-status="isError('table_name')"
            :help="getErrorMessage('table_name')"
        >
          <a-select
              v-model:value="data.table_name"
              show-search
              style="width: 100%"
              placeholder="Ressource"
              :max-tag-count="10"
              :options="store.tables"
              :filter-option="dropDownFilter"
          />
        </a-form-item>
      </section>
      <section class="middle-section">
        <a-form-item
            :validate-status="isError('log_type')"
            :help="getErrorMessage('log_type')"
        >
          <a-select
              v-model:value="data.log_type"
              show-search
              style="width: 100%"
              placeholder="Type d'action"
              :max-tag-count="10"
              :options="store.log_types"
              :filter-option="dropDownFilter"
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
