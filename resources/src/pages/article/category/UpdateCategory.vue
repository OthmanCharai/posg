<script setup lang="ts">
import {clearError, getErrorMessage, isError} from "@/src/utils/error-handler";
import {useArticleCategoryStore} from "@stores/articleCategory.store";
import {ArticleCategory} from "@common/types/global/articleCategory";

const showUpdateModal = inject('showUpdateModal') as Ref<boolean>;
const store = useArticleCategoryStore();
const showCreateModal = inject('showCreateModal') as Ref<boolean>;

const data = ref<ArticleCategory>({
  name: store.currentCategory.name,
});

// Submit data
const handleSubmission = async () => {
  await store.update(store.currentCategory, data.value, showUpdateModal);
};
</script>

<template>
  <ModalWrapper title="Nouveau Article category" v-model:open="showUpdateModal" @submit="handleSubmission"
                width="800px">
    <section class="grid grid-cols-1 gap-4">
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
