<script setup lang="ts">
  import { clearError, getErrorMessage, isError } from '@/src/utils/error-handler';
  import { useArticleCompatibilityStore } from '@stores/compatibility.store';
  import type { ArticleCompatibility } from '@common/types/articles';

  const showUpdateModal = inject('showUpdateModal') as Ref<boolean>;
  const store = useArticleCompatibilityStore();

  const data = ref<ArticleCompatibility>({
    name: store.currentCompatibility.name,
  });

  // Submit data
  const handleSubmission = async () => {
    await store.update(store.currentCompatibility, data.value, showUpdateModal);
  };
</script>

<template>
  <ModalWrapper
    title="Edité votre compatibilié"
    v-model:open="showUpdateModal"
    @submit="handleSubmission"
    width="450px"
  >
    <section class="grid grid-cols-1 gap-4 border-t pt-4 pb-1">
      <div class="grid gap-4">
        <a-form-item
          :validate-status="isError('name')"
          :help="getErrorMessage('name')"
        >
          <a-input
            type="text"
            addonBefore="Nome"
            v-model:value="data.name"
            @change="clearError('name')"
          />
        </a-form-item>
      </div>
    </section>
  </ModalWrapper>
  <Loader :is-active="store.loading" />
</template>
