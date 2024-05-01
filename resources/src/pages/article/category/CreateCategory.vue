<script setup lang="ts">
import {clearError, getErrorMessage, isError} from "@/src/utils/error-handler";
import {useArticleCategoryStore} from "@stores/articleCategory.store";
import {ArticleCategory} from "@common/types/global/articleCategory";

const store = useArticleCategoryStore();
const showCreateModal = inject('showCreateModal') as Ref<boolean>;

const data = ref<ArticleCategory>({
  name: '',
});

// Submit data
const handleSubmission = async () => {
  await store.create(data.value, showCreateModal);
};
</script>

<template>
  <ModalWrapper title="Nouveau Article category" v-model:open="showCreateModal" @submit="handleSubmission" width="450px">
    <section class="grid grid-cols-1 gap-4 border-t pt-4 pb-1">
      <div class="grid gap-4">
        <a-form-item
            :validate-status="isError('name')"
            :help="getErrorMessage('name')"
        >
          <a-input type="text" addonBefore="Nome" v-model:value="data.name" @change="clearError('name')"/>
        </a-form-item>
      </div>
    </section>
  </ModalWrapper>
  <Loader :is-active="store.loading"/>
</template>
