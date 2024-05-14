import type { Depot } from '@common/types/global/depot';
export interface ArticleInfo {
  id?: string,
  code_bare: string,
  supplier_id: string,
  name: string,
  emplacement: string,
  purchase_price: string,
  wholesale_price: string,
  retail_price: string,
  last_sale_price: string,
  stock_type: number,
  brand_id: string,
  article_category_id: string,
  image: File | string | null | undefined,
  description: string,
  compatibilities: ArticleCompatibility[],
  depots: Depot[],

}

export interface ArticleCompatibility {
  id?: string,
  name: string,
}

export interface ArticleIso {
  id?: string,
  article_id?: string,
  value: string,
}
