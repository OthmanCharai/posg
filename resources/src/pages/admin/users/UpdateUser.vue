<script setup lang="ts">
import { SelectProps } from 'ant-design-vue/es/vc-select/Select';

const showModal = inject('showUpdateModal') as Ref<boolean>;

const data = ref({
  userName: '',
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
  <ModalWrapper title="Utilisateur" v-model:open="showModal" @submit="handleSubmission" width="800px">
  <a-divider class="!text-xl">Données personnelles</a-divider>
  <section class="grid grid-cols-2 gap-4">
    <div class="grid gap-4">
      <a-form-item
        validate-status=""
        help=""
      >
        <a-input addonBefore="Nom d'utilisateur" v-model:value="data.userName" />
      </a-form-item>

      <a-form-item
        validate-status=""
        help=""
      >
        <a-input addonBefore="Mot de passe" v-model:value="data.userName" />
      </a-form-item>

      <a-form-item
        validate-status=""
        help=""
      >
        <a-input addonBefore="Nom" v-model:value="data.userName" />
      </a-form-item>

      <a-form-item
        validate-status=""
        help=""
      >
        <a-input addonBefore="Prenom" v-model:value="data.userName" />
      </a-form-item>
    </div>
    <div>
      <a-form-item
        validate-status=""
        help=""
      >
        <a-textarea placeholder="Address" class="h-[88px!important] mb-4" v-model:value="data.userName" />
      </a-form-item>

      <a-form-item
        validate-status=""
        help=""
      >
        <a-input addonBefore="Tel" v-model:value="data.userName" />
      </a-form-item>
    </div>
  </section>
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
    <a-upload
      v-model:file-list="fileList"
      name="avatar"
      list-type="picture-card"
      class="avatar-uploader"
      :show-upload-list="false"
    >
      <img v-if="imageUrl" :src="imageUrl" alt="avatar" />
      <div v-else>
        <div class="ant-upload-text">Upload</div>
      </div>
    </a-upload>
  </section>
</ModalWrapper>
</template>
