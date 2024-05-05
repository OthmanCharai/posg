<script setup lang="ts">
  import { clearError, getErrorMessage, isError } from '@/src/utils/error-handler';
  import type { UploadProps } from 'ant-design-vue';
  import { useBrandStore } from '@stores/brand.store';
  import type { Brand } from '@common/types/global/brand';
  import { PlusOutlined } from '@ant-design/icons-vue';

  const store = useBrandStore();
  const showCreateModal = inject('showCreateModal') as Ref<boolean>;

  const data = ref<Brand>({
    name: '',
    abbreviation: '',
    path: '',
  });

  // Submit data
  const handleSubmission = async () => {
    if (fileList.value && fileList.value?.length > 0) {
      data.value.path = fileList.value[0].originFileObj;
    }

    const formData = new FormData();

    Object.entries(data.value).forEach(([key, value]) => {
      formData.append(key, value ?? '');
    });

    await store.create(formData, showCreateModal);
  };

  // upload image
  const fileList = ref<UploadProps['fileList']>([]);

  const stopAntdvDefaultRequest = () => {
    return false; // This stops the upload request of antdv
  };
</script>

<template>
  <ModalWrapper
    title="Nouveau Marque"
    v-model:open="showCreateModal"
    @submit="handleSubmission"
    width="800px"
  >
    <a-divider class="!text-xl">
      Données
    </a-divider>
    <section class="grid grid-cols-2 gap-4">
      <div class="grid gap-4">
        <a-form-item :validate-status="isError('name')" :help="getErrorMessage('name')">
          <a-input
            type="text"
            addonBefore="Nom"
            v-model:value="data.name"
            @change="clearError('name')"
          />
        </a-form-item>
        <a-form-item
          :validate-status="isError('abbreviation')"
          :help="getErrorMessage('abbreviation')"
        >
          <a-input
            type="text"
            addonBefore="Abbreviation"
            v-model:value="data.abbreviation"
            @change="clearError('abbreviation')"
          />
        </a-form-item>
      </div>
      <section class="last-section">
        <div class="flex justify-center">
          <a-upload
            v-model:file-list="fileList"
            name="avatar"
            list-type="picture-card"
            class="upload-list-inline"
            :before-upload="stopAntdvDefaultRequest"
            accept="image/png, image/jpeg"
          >
            <div v-if="fileList && fileList.length < 1">
              <plus-outlined />
              <div class="ant-upload-text">
                Upload
              </div>
            </div>
          </a-upload>
        </div>
        <a-divider class="!text-xl">
          Image
        </a-divider>
      </section>
    </section>
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
