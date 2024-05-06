import { defineStore } from 'pinia';
import { route, useAxios } from '@utils/axios-helper';
import { extractPaginatorObject } from '@utils/pagination';
import type { PaginationMetadata } from '@common/types/global/pagination';
import type { ArticleInfo } from '@common/types/articles';
import { Toast } from '@utils/toast';
import type { SelectProps } from 'ant-design-vue/es/vc-select/Select';
import type { ArticleCategory } from '@common/types/global/articleCategory';
import type { Brand } from '@common/types/global/brand';
import type { Supplier } from '@common/types/global/supplier';
import type { ArticleCompatibility } from '@common/types/compatibility';

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
      });
      if (response.value && response.value.data) {
        this.articlesData = response.value.data.articles.data;
        this.pagination = extractPaginatorObject(response.value.data.articles);
        this.getResponse = true;
      }
    },

    getCompatibilityList(compatibilities: ArticleCompatibility[]) {
      this.compatibilityList = compatibilities.map(compatibility => ({
        label: compatibility.name,
        value: compatibility.id
      }));
    },

    getArticleCategoryList(categories: ArticleCategory[]) {
      this.articleCategoryList = categories.map(category => ({
        label: category.name,
        value: category.id
      }));
    },

    getBrandList(brands: Brand[]) {
      this.brandList = brands.map(brand => ({
        label: brand.name,
        value: brand.id
      }));
    },

    getSupplierList(suppliers: Supplier[]) {
      this.supplierList = suppliers.map(supplier => ({
        label: supplier.company_name,
        value: supplier.id
      }));
    },

    async getCreationData() {
      await request({
        url: route('articles.create.data'),
        method: 'GET'
      });
      if (response.value && response.value.data) {
        this.getArticleCategoryList(response.value.data.article_categories);
        this.getSupplierList(response.value.data.suppliers);
        this.getBrandList(response.value.data.brands);
        this.getCompatibilityList(response.value.data.compatibilities);
      }
    },

    async create(formData: ArticleInfo) {
      await request({
        method: 'POST',
        url: route('articles.create'),
        data: formData,
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });

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
          'Content-Type': 'multipart/form-data',
        },
        params: {
          _method: 'PUT',
        },
      });

      if (response.value && response.value.data) {
        Toast.success('Votre compte a été mis à jour avec succès.');
      }
    },

    setSelectedArticle(data: ArticleInfo) {
      this.selectedArticle = data;
    },
  }
});
