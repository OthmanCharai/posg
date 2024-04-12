<script setup lang="ts">
import type { Users } from '@common/types/users';
import { SelectProps } from 'ant-design-vue/es/vc-select/Select';

const showModal = inject('showCreateModal') as Ref<boolean>;

const data = ref<Users>({
  first_name: '',
  last_name: '',
  email: '',
  password: '',
  phone_number: '',
  address: '',
  logo: '',
})

const options = ref<SelectProps['options']>([
  { value: 'jack', label: 'Jack' },
  { value: 'lucy', label: 'Lucy' },
  { value: 'tom', label: 'Tom' },
]);

const filterOption = (input: string, option: any) => {
  return option.value.toLowerCase().indexOf(input.toLowerCase()) >= 0;
};

const handleSubmission = () => {
  console.log('hello');
};

const fileList = ref([]);
const imgLoader = ref<boolean>(false);
const imageUrl = ref<string>('');
</script>

<template>
  <ModalWrapper title="Nouveau utilisateur" v-model:open="showModal" @submit="handleSubmission" width="800px">
    <a-divider class="!text-xl">Données personnelles</a-divider>
    <section class="grid grid-cols-2 gap-4">
      <div class="grid gap-4">
        <a-form-item
          validate-status=""
          help=""
        >
          <a-input addonBefore="Email" v-model:value="data.email" />
        </a-form-item>

        <a-form-item
          validate-status=""
          help=""
        >
          <a-input addonBefore="Mot de passe" v-model:value="data.password" />
        </a-form-item>

        <a-form-item
          validate-status=""
          help=""
        >
          <a-input addonBefore="Nom" v-model:value="data.first_name" />
        </a-form-item>

        <a-form-item
          validate-status=""
          help=""
        >
          <a-input addonBefore="Prenom" v-model:value="data.last_name" />
        </a-form-item>
      </div>
      <div>
        <a-form-item
          validate-status=""
          help=""
        >
          <a-textarea placeholder="Address" class="h-[88px!important] mb-4" v-model:value="data.address" />
        </a-form-item>

        <a-form-item
          validate-status=""
          help=""
        >
          <a-input addonBefore="Tel" v-model:value="data.phone_number" />
        </a-form-item>
      </div>
    </section>
    <div class="grid grid-cols-2 gap-4">
      <section class="middle-section">
        <a-divider class="!text-xl">Roles</a-divider>
        <a-select
          v-model:value="data.userName"
          show-search
          style="width: 100%"
          placeholder="Select a person"
          :options="options"
          :filter-option="filterOption"
        ></a-select>
      </section>
      <section class="last-section">
        <a-divider class="!text-xl">Image</a-divider>
        <div class="flex justify-center">
          <a-upload
          v-model:file-list="fileList"
          name="avatar"
          list-type="picture-card"
          class="avatar-uploader max-w-max"
          :show-upload-list="false"
        >
          <img v-if="imageUrl" :src="imageUrl" alt="avatar" />
          <div v-else>
            <loading-outlined v-if="imgLoader"></loading-outlined>
            <plus-outlined v-else></plus-outlined>
            <div class="ant-upload-text">Upload</div>
          </div>
        </a-upload>
        </div>
      </section>
    </div>
  </ModalWrapper>
</template>
