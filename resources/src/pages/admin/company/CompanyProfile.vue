<script lang="ts" setup>
  import type { Company } from '@/src/common/types/global/company';
  import { clearError, getErrorMessage, isError } from '@/src/utils/error-handler';
  import type { UploadProps } from 'ant-design-vue';
  import { useCompanyStore } from '@/src/stores/company.store';
  import { PlusOutlined } from '@ant-design/icons-vue';

  const store = useCompanyStore();

  const data = ref<Company>({
    name: '',
    phone: '',
    email: '',
    website: '',
    address: '',
    capital: 0,
    num_rc: '',
    num_nif: '',
    num_statistique: '',
    num_bgfi: '',
    num_ugb: '',
    return_policy: '',
    path: '',
  });

  onMounted(async () => {
    await store.get();
    data.value = {
      name: store.company.name,
      phone: store.company.phone,
      email: store.company.email,
      website: store.company.website,
      address: store.company.address,
      capital: store.company.capital,
      num_rc: store.company.num_rc,
      num_nif: store.company.num_nif,
      num_statistique: store.company.num_statistique,
      num_bgfi: store.company.num_bgfi,
      num_ugb: store.company.num_ugb,
      return_policy: store.company.return_policy,
      path: store.company.path,
    };
    await nextTick();

    if (data.value.path && fileList.value && fileList.value.length === 0) {
      const image: UploadProps['fileList'][number] = {
        uid: 'index-1',
        status: 'done',
        thumbUrl: data.value.path as string,
      };

      fileList.value.push(image);
    }
  });

  const changeImage = () => {
    if (fileList.value && fileList.value.length > 0) {
      return (data.value.path = fileList.value[0].originFileObj);
    }
  };

  const removeImage = () => {
    if (data.value.path) {
      data.value.path = '';
      return true;
    }
  };

  // upload image
  const fileList = ref<UploadProps['fileList']>([]);

  const stopAntdvDefaultRequest = () => {
    return false;
  };

  const submitForm = async () => {
    if (fileList.value && fileList.value?.length > 0) {
      data.value.path = fileList.value[0].originFileObj;
    }

    const formData = new FormData();

    Object.entries(data.value).forEach(([key, value]) => {
      formData.append(key, value ?? '');
    });
    if (store.company.id) {
      await store.update(store.company, formData);
    } else {
      await store.create(formData);
    }
  };
</script>
<template>
  <div class="settings-page-wrap">
    <form @submit.prevent="submitForm">
      <a-card title="Logo du Societe" style="width: 100%">
        <div class="flex justify-center">
          <a-upload
            v-model:file-list="fileList"
            name="avatar"
            list-type="picture-card"
            class="upload-list-inline"
            :before-upload="stopAntdvDefaultRequest"
            @remove="removeImage"
            @change="changeImage"
            :maxCount="1"
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
      </a-card>
      <br>
      <a-card title="Generale Informations" style="width: 100%">
        <div class="grid md:grid-cols-2 gap-5">
          <a-form-item :validate-status="isError('name')" :help="getErrorMessage('name')">
            <a-input
              type="text"
              addonBefore="Nom Societe"
              v-model:value="data.name"
              @change="clearError('name')"
            />
          </a-form-item>
          <a-form-item
            :validate-status="isError('phone')"
            :help="getErrorMessage('phone')"
          >
            <a-input
              type="number"
              addonBefore="Telephone"
              v-model:value="data.phone"
              @change="clearError('phone')"
            />
          </a-form-item>
          <a-form-item
            :validate-status="isError('email')"
            :help="getErrorMessage('email')"
          >
            <a-input
              type="email"
              addonBefore="Email"
              v-model:value="data.email"
              @change="clearError('email')"
            />
          </a-form-item>
          <a-form-item
            :validate-status="isError('website')"
            :help="getErrorMessage('website')"
          >
            <a-input
              type="text"
              addonBefore="website"
              v-model:value="data.website"
              @change="clearError('website')"
            />
          </a-form-item>
        </div>
      </a-card>
      <br>
      <a-card title="Capital et autres Informations" style="width: 100%">
        <div class="grid md:grid-cols-2 gap-5">
          <a-form-item
            :validate-status="isError('capital')"
            :help="getErrorMessage('capital')"
          >
            <a-input
              type="number"
              addonBefore="Capital"
              v-model:value="data.capital"
              @change="clearError('capital')"
            />
          </a-form-item>
          <a-form-item
            :validate-status="isError('num_rc')"
            :help="getErrorMessage('num_rc')"
          >
            <a-input
              type="number"
              addonBefore="Num RC"
              v-model:value="data.num_rc"
              @change="clearError('num_rc')"
            />
          </a-form-item>
          <a-form-item
            :validate-status="isError('num_nif')"
            :help="getErrorMessage('num_nif')"
          >
            <a-input
              type="number"
              addonBefore="Num N.I.F"
              v-model:value="data.num_nif"
              @change="clearError('num_nif')"
            />
          </a-form-item>
          <a-form-item
            :validate-status="isError('num_statistique')"
            :help="getErrorMessage('num_statistique')"
          >
            <a-input
              type="number"
              addonBefore="Num statistique"
              v-model:value="data.num_statistique"
              @change="clearError('num_statistique')"
            />
          </a-form-item>
          <a-form-item
            :validate-status="isError('num_ugb')"
            :help="getErrorMessage('num_ugb')"
          >
            <a-input
              type="number"
              addonBefore="Num U.G.B"
              v-model:value="data.num_ugb"
              @change="clearError('num_ugb')"
            />
          </a-form-item>
          <a-form-item
            :validate-status="isError('num_bgfi')"
            :help="getErrorMessage('num_bgfi')"
          >
            <a-input
              type="number"
              addonBefore="Num B.G.F.I"
              v-model:value="data.num_bgfi"
              @change="clearError('num_bgfi')"
            />
          </a-form-item>
          <a-form-item>
            <a-textarea
              placeholder="Address"
              class="h-[88px!important] mb-4"
              v-model:value="data.address"
            />
          </a-form-item>
          <a-form-item>
            <a-textarea
              placeholder="Politique de retour"
              class="h-[88px!important] mb-4"
              v-model:value="data.return_policy"
            />
          </a-form-item>
        </div>
      </a-card>
      <div class="my-5 flex justify-end">
        <a-button htmlType="submit" type="primary">
          <vue-feather :size="16" type="save" />
          <span v-if="store.company.id">Modifier</span>
          <span v-else>Enregister</span>
        </a-button>
      </div>
    </form>
  </div>
</template>

<style scoped>
  .upload-list-inline :deep(.ant-upload-list-item-actions) {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .upload-list-inline :deep(.ant-upload-list-item-actions a) {
    display: none !important;
  }
</style>
