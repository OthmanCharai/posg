<script setup lang="ts">
  import { clearError, getErrorMessage, isError } from '@/src/utils/error-handler';
  import { useArticlesStore } from '@stores/articles.store';
  import type { Depot } from '@common/types/global/depot';
  import { useArticleDepotStore } from '@stores/articleDepot.store';
  import { dropDownFilter } from '@/src/composables/filters';

  const store = useArticleDepotStore();
  const storeArticle = useArticlesStore();
  const showCreateModal = inject('showCreateModal') as Ref<boolean>;

  const data = ref<Depot>({
    depot_id: '',
    quantity: ''
  });

  // Submit data
  const handleSubmission = async () => {
    await store.create(data.value, storeArticle.selectedArticle, showCreateModal);
  };
</script>

<template>
  <ModalWrapper
    title="Nouveau dépot"
    v-model:open="showCreateModal"
    @submit="handleSubmission"
    width="450px"
  >
    <section class="grid grid-cols-1 gap-4 border-t pt-4 pb-1">
      <div class="grid gap-4">
        <a-form-item
          class="dropdown-label"
          label="Dépots"
          :validate-status="isError('depot_id')"
          :help="getErrorMessage('depot_id')"
        >
          <a-select
            v-model:value="data.depot_id"
            show-search
            style="width: 100%;"
            :options="storeArticle.depots"
            :filter-option="dropDownFilter"
            @change="clearError('depot_id')"
          />
        </a-form-item>
        <a-form-item
          label="Quantité"
          :validate-status="isError('quantity')"
          :help="getErrorMessage('quantity')"
        >
          <a-input
            type="number"
            v-model:value="data.quantity"
            @change="clearError('quantity')"
          />
        </a-form-item>
      </div>
    </section>
  </ModalWrapper>
  <Loader :is-active="store.loading" />
</template>

<style scoped>
  .dropdown-label :deep(label::after) {
    margin-right: 16px !important;
  }
</style>
