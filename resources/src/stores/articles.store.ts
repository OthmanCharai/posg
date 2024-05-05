import { defineStore } from 'pinia';
import { useAxios, route } from '@utils/axios-helper';
import { extractPaginatorObject } from '@utils/pagination';
import type { PaginationMetadata } from '@common/types/global/pagination';
import type { ArticleInfo } from '@common/types/articles';
import { Toast } from '@utils/toast';
import { useArticleCompatibilityStore } from "@stores/compatibility.store";
import { useArticleCategoryStore } from "@stores/articleCategory.store";
import { useBrandStore } from "@stores/brand.store";
import { useSupplierStore } from "@stores/supplier.store";
import type { SelectProps } from 'ant-design-vue/es/vc-select/Select';

// Use stores
const storeCompatibility = useArticleCompatibilityStore();
const storeCategory = useArticleCategoryStore();
const storeBrand = useBrandStore();
const storeSupplier = useSupplierStore();

const { request, response, loading } = useAxios();

export const useArticlesStore = defineStore('articles', {
  state: () => ({
    articlesData: [] as ArticleInfo[],
    selectedArticle: {} as ArticleInfo,
    pagination: {} as PaginationMetadata,
    compatibilityList: [] as SelectProps['options'],
    articleCategoryList: [] as SelectProps['options'],
    brandList: [] as SelectProps['options'],
    supplierList: [] as SelectProps['options'],
    loading: loading,
    getResponse: false,
  }),

  actions: {
    async get(page: number = 1) {
      await request({
        method: 'GET',
        url: route('articles.index', `page=${page}`)
      })
      if (response.value && response.value.data) {
        this.articlesData = response.value.data.users.data;
        this.pagination = extractPaginatorObject(response.value.data.users);
        this.getResponse = true;
      }
    },

    async getCompatibilityList() {
      await storeCompatibility.get();

      this.compatibilityList = storeCompatibility.compatibilities.map(compatibility => ({
        label: compatibility.name,
        value: compatibility.id
      }));
    },

    async getArticleCategoryList() {
      await storeCategory.get();

      this.articleCategoryList = storeCategory.categories.map(category => ({
        label: category.name,
        value: category.id
      }));
    },

    async getBrandList() {
      await storeBrand.get();

      this.brandList = storeBrand.brands.map(brand => ({
        label: brand.name,
        value: brand.id
      }));
    },

    async getSupplierList() {
      await storeSupplier.get();

      this.supplierList = storeSupplier.suppliers.map(supplier => ({
        label: supplier.company_name,
        value: supplier.id
      }));
    },

    async create(formData: ArticleInfo) {
      await request({
        method: 'POST',
        url: route('articles.create.submit'),
        data: formData,
        headers: {
          "Content-Type": "multipart/form-data",
        },
      })

      if (response.value && response.value.data) {
        Toast.success('Votre article a été crée avec succès.');
      }
    },

    async update(formData: ArticleInfo) {
      await request({
        method: 'POST',
        url: route('articles.update', this.selectedArticle.id),
        data: formData,
        headers: {
          "Content-Type": "multipart/form-data",
        },
        params: {
          _method: "PUT",
        },
      })

      if (response.value && response.value.data) {
        Toast.success('Votre compte a été mis à jour avec succès.');
      }
    },

    setSelectedArticle(data: ArticleInfo) {
      this.selectedArticle = data;
    },
  }
})
