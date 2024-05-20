<script setup lang="ts">
  import { clearError, getErrorMessage, isError } from '@/src/utils/error-handler';
  import { useArticleIsoStore } from '@stores/articleIso.store';
  import { useArticlesStore } from '@stores/articles.store';
  import type { ArticleIso } from '@common/types/articles';

  const storeIso = useArticleIsoStore();
  const storeArticle = useArticlesStore();
  const showCreateModal = inject('showCreateModal') as Ref<boolean>;

  const data = ref<ArticleIso>({
    value: '',
  });

  // Submit data
  const handleSubmission = async () => {
    await storeIso.create(data.value, storeArticle.selectedArticle, showCreateModal);
  };
</script>

<template>
  <ModalWrapper
    title="Nouveau ISO"
    v-model:open="showCreateModal"
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
