export interface Taxes {
  id?: string;
  name: string;
  tax_variants?: TaxeVariants[];
}

export interface TaxeVariants {
  id?: string;
  tax_id?: string;
  name: string;
  value: string;
  type: number;
  created_at?: string;
  updated_at?: string;
}
