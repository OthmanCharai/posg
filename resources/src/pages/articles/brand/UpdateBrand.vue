<script setup lang="ts">
import {clearError, getErrorMessage, isError} from "@/src/utils/error-handler";
import type {UploadProps} from 'ant-design-vue';
import {useBrandStore} from "@stores/brand.store";
import {Brand} from "@common/types/global/brand";
import {PlusOutlined} from "@ant-design/icons-vue";

const store = useBrandStore();
const showUpdateModal = inject('showUpdateModal') as Ref<boolean>;

const data = ref<Brand>({
  name: store.currentBrand.name,
  abbreviation: store.currentBrand.abbreviation,
  path: store.currentBrand.path
});

// Submit data
const handleSubmission = async () => {
  if (fileList.value && fileList.value?.length > 0) {
    data.value.path = fileList.value[0].originFileObj;
  }

  const formData = new FormData();

  Object.entries(data.value).forEach(([key, value]) => {
    formData.append(key, value ?? "");
  });

  await store.update(store.currentBrand, formData, showUpdateModal);
};

// upload image
const fileList = ref<UploadProps['fileList']>([]);

const stopAntdvDefaultRequest = () => {
  return false; // This stops the upload request of antdv
}

const changeImage = () => {
  if (fileList.value && fileList.value.length > 0) {
    return data.value.logo = fileList.value[0].originFileObj;
  }
}

const removeImage = () => {
  if (data.value.path) {
    data.value.path = '';
    return true;
  }
}

onMounted(async () => {
  if (data.value.path && fileList.value && fileList.value.length === 0) {
    const image: UploadProps['fileList'][number] = {
      uid: 'index-1',
      status: 'done',
      thumbUrl: data.value.logo as string,
    };

    fileList.value.push(image);
  }
})
</script>

<template>
  <ModalWrapper title="Nouveau Marque" v-model:open="showUpdateModal" @submit="handleSubmission" width="800px">
    <a-divider class="!text-xl">Données</a-divider>
    <section class="grid grid-cols-2 gap-4">
      <div class="grid gap-4">
        <a-form-item
            :validate-status="isError('name')"
            :help="getErrorMessage('name')"
        >
          <a-input type="text" addonBefore="Nom" v-model:value="data.name" @change="clearError('name')"/>
        </a-form-item>
        <a-form-item
            :validate-status="isError('abbreviation')"
            :help="getErrorMessage('abbreviation')"
        >
          <a-input type="text" addonBefore="Abbreviation" v-model:value="data.abbreviation"
                   @change="clearError('abbreviation')"/>
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
              @remove="removeImage"
              @change="changeImage"
              :maxCount="1"
          >
            <div v-if="fileList && fileList.length < 1">
              <plus-outlined></plus-outlined>
              <div class="ant-upload-text">Upload</div>
            </div>
          </a-upload>
        </div>
        <a-divider class="!text-xl">Image</a-divider>
      </section>
    </section>
  </ModalWrapper>
  <Loader :is-active="store.loading"/>
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
