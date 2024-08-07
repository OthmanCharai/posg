<script setup lang="ts">
  import { clearError, getErrorMessage, isError } from '@/src/utils/error-handler';
  import { dropDownFilter } from '@/src/composables/filters';
  import type { UploadProps } from 'ant-design-vue';
  import { BarcodeOutlined, PlusOutlined } from '@ant-design/icons-vue';
  import type { ArticleInfo } from '@common/types/articles';
  import { useArticlesStore } from '@stores/articles.store';

  const store = useArticlesStore();

  const data = ref<ArticleInfo>({
    code_bare: store.selectedArticle.code_bare || '',
    supplier_id: store.selectedArticle.supplier_id || '',
    name: store.selectedArticle.name || '',
    emplacement: store.selectedArticle.emplacement || '',
    purchase_price: store.selectedArticle.purchase_price || '',
    wholesale_price: store.selectedArticle.wholesale_price || '',
    retail_price: store.selectedArticle.retail_price || '',
    last_sale_price: store.selectedArticle.last_sale_price || '',
    stock_type: store.selectedArticle.stock_type || 0,
    brand_id: store.selectedArticle.brand_id || '',
    article_category_id: store.selectedArticle.article_category_id || '',
    image: store.selectedArticle.image || '',
    description: store.selectedArticle.description || '',
    compatibilities: store.selectedArticle.compatibilities || []
  });

  // upload image
  const fileList = ref<UploadProps['fileList']>([]);

  const stopAntdvDefaultRequest = () => {
    return false; // This stops the upload request of antdv
  };

  const changeImage = () => {
    if (fileList.value && fileList.value.length > 0) {
      return data.value.image = fileList.value[0].originFileObj;
    }
  };

  const removeImage = () => {
    if (data.value.image) {
      data.value.image = '';
      return true;
    }
  };

  // Submit data
  const handleSubmission = async () => {
    if (fileList.value && fileList.value?.length > 0) {
      data.value.image = fileList.value[0].originFileObj;
    }

    const formData = new FormData();

    data.value.compatibilities.forEach((compatibility) => {
      formData.append('compatibilities[]', compatibility as any);
    });

    if(store.selectedArticle.id) {
      Object.entries(data.value).forEach(([key, value]) => {
        if (key === 'image' && typeof value === 'string') {
          return;
        } else if (key === 'compatibilities') {
          return;
        } else {
          formData.append(key, value ?? '' as any);
        }
      });
      await store.update(formData);
    } else {
      Object.entries(data.value).forEach(([key, value]) => {
        if(key === 'compatibilities') {
          return;
        } else {
          formData.append(key, value ?? '' as any);
        }
      });
      await store.create(formData);
    }
  };

  onMounted(async () => {
    if (data.value.image && fileList.value && fileList.value.length === 0) {
      const image: UploadProps['fileList'][number] = {
        uid: 'index-1',
        status: 'done',
        thumbUrl: data.value.image as string,
      };

      fileList.value.push(image);
    }
  });
</script>

<template>
  <a-form
    layout="vertical"
    class="mb-5"
    @submit.prevent="handleSubmission"
  >
    <a-card style="width: 100%">
      <div class="grid lg:grid-cols-2 gap-4">
        <a-form-item
          label="UPC/EAN/ISBN"
          :validate-status="isError('code_bare')"
          :help="getErrorMessage('code_bare')"
        >
          <a-input
            type="text"
            v-model:value="data.code_bare"
            @change="clearError('code_bare')"
          >
            <template #addonBefore>
              <BarcodeOutlined />
            </template>
          </a-input>
        </a-form-item>
        <a-form-item
          label="Fournisseur"
          :validate-status="isError('supplier_id')"
          :help="getErrorMessage('supplier_id')"
        >
          <a-select
            v-model:value="data.supplier_id"
            show-search
            style="width: 100%;"
            :options="store.supplierList"
            :filter-option="dropDownFilter"
            @change="clearError('supplier_id')"
          />
        </a-form-item>
        <a-form-item
          label="Nom"
          :validate-status="isError('name')"
          :help="getErrorMessage('name')"
        >
          <a-input
            type="text"
            v-model:value="data.name"
            @change="clearError('name')"
          />
        </a-form-item>
        <a-form-item
          label="Emplacement"
          :validate-status="isError('emplacement')"
          :help="getErrorMessage('emplacement')"
        >
          <a-input
            type="text"
            v-model:value="data.emplacement"
            @change="clearError('emplacement')"
          />
        </a-form-item>
        <a-form-item
          label="Prix d'achat"
          :validate-status="isError('purchase_price')"
          :help="getErrorMessage('purchase_price')"
        >
          <a-input-number
            type="number"
            :controls="false"
            addonBefore="XAF"
            style="width: 100%"
            v-model:value="data.purchase_price"
            @change="clearError('purchase_price')"
          />
        </a-form-item>
        <a-form-item
          label="Prix de Gros"
          :validate-status="isError('wholesale_price')"
          :help="getErrorMessage('wholesale_price')"
        >
          <a-input-number
            type="number"
            :controls="false"
            style="width: 100%"
            addonBefore="XAF"
            v-model:value="data.wholesale_price"
            @change="clearError('wholesale_price')"
          />
        </a-form-item>
        <a-form-item
          label="Prix au Détail"
          :validate-status="isError('retail_price')"
          :help="getErrorMessage('retail_price')"
        >
          <a-input-number
            type="number"
            :controls="false"
            style="width: 100%"
            addonBefore="XAF"
            v-model:value="data.retail_price"
            @change="clearError('retail_price')"
          />
        </a-form-item>
        <a-form-item
          label="Dernier prix de vente"
          :validate-status="isError('last_sale_price')"
          :help="getErrorMessage('last_sale_price')"
        >
          <a-input-number
            type="number"
            :controls="false"
            style="width: 100%"
            addonBefore="XAF"
            v-model:value="data.last_sale_price"
            @change="clearError('last_sale_price')"
          />
        </a-form-item>
        <a-form-item
          label="Marque"
          :validate-status="isError('brand_id')"
          :help="getErrorMessage('brand_id')"
        >
          <a-select
            v-model:value="data.brand_id"
            show-search
            style="width: 100%;"
            :options="store.brandList"
            :filter-option="dropDownFilter"
            @change="clearError('brand_id')"
          />
        </a-form-item>
        <a-form-item
          label="Catégorie"
          :validate-status="isError('article_category_id')"
          :help="getErrorMessage('article_category_id')"
        >
          <a-select
            v-model:value="data.article_category_id"
            show-search
            style="width: 100%;"
            :options="store.articleCategoryList"
            :filter-option="dropDownFilter"
            @change="clearError('article_category_id')"
          />
        </a-form-item>
        <a-form-item
          label="Type de stock"
          :validate-status="isError('stock_type')"
          :help="getErrorMessage('stock_type')"
        >
          <a-radio-group v-model:value="data.stock_type">
            <a-radio :value="0">
              Stock/Magasines
            </a-radio>
            <a-radio :value="1">
              Non-stocké
            </a-radio>
          </a-radio-group>
        </a-form-item>
        <a-form-item
          label="Compatibilities"
          :validate-status="isError('compatibilities')"
          :help="getErrorMessage('compatibilities')"
        >
          <a-select
            v-model:value="(data.compatibilities as [])"
            show-search
            style="width: 100%"
            mode="multiple"
            :max-tag-count="10"
            :options="store.compatibilityList"
            :filter-option="dropDownFilter"
            @change="clearError('compatibilities')"
          />
        </a-form-item>
        <a-form-item
          label="Image"
          :validate-status="isError('image')"
          :help="getErrorMessage('image')"
        >
          <a-upload
            v-model:file-list="fileList"
            name="image"
            list-type="picture-card"
            class="upload-list-inline"
            accept="image/png, image/jpeg"
            :before-upload="stopAntdvDefaultRequest"
            @remove="removeImage"
            @change="changeImage"
            :maxCount="1"
          >
            <div v-if="fileList && fileList.length < 1">
              <plus-outlined />
              <div class="ant-upload-text">
                Upload
              </div>
            </div>
          </a-upload>
        </a-form-item>
        <a-form-item
          label="Description"
          :validate-status="isError('description')"
          :help="getErrorMessage('description')"
        >
          <a-textarea class="h-[100px!important]" v-model:value="data.description" />
        </a-form-item>
      </div>
    </a-card>
    <div class="flex justify-end mt-5">
      <a-button htmlType="submit" type="primary">
        <div v-if="store.selectedArticle.id" class="flex gap-2 items-center">
          <vue-feather :size="16" type="edit" />
          <span>Modifié</span>
        </div>
        <div v-else class="flex gap-2 items-center">
          <vue-feather :size="16" type="save" />
          <span>Enregister</span>
        </div>
      </a-button>
    </div>
  </a-form>
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
