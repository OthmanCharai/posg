<script setup lang="ts">
  import { clearError, getErrorMessage, isError } from '@/src/utils/error-handler';
  import { useArticleIsoStore } from '@stores/articleIso.store';
  import type { ArticleIso } from '@common/types/articles';

  const showUpdateModal = inject('showUpdateModal') as Ref<boolean>;
  const storeIso = useArticleIsoStore();

  const data = ref<ArticleIso>({
    value: storeIso.currentArticleIso.value,
  });

  // Submit data
  const handleSubmission = async () => {
    await storeIso.update(data.value, storeIso.currentArticleIso, showUpdateModal);
  };
</script>

<template>
  <ModalWrapper
    title="Edité votre ISO"
    v-model:open="showUpdateModal"
    @submit="handleSubmission"
    width="450px"
  >
    <section class="grid grid-cols-1 gap-4 border-t pt-4 pb-1">
      <div class="grid gap-4">
        <a-form-item
          :validate-status="isError('value')"
          :help="getErrorMessage('value')"
        >
          <a-input
            type="text"
            addonBefore="Valeur"
            v-model:value="data.value"
            @change="clearError('value')"
          />
        </a-form-item>
      </div>
    </section>
  </ModalWrapper>
  <Loader :is-active="storeIso.loading" />
</template>
