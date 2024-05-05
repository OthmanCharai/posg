export interface Company {
  id?: string;
  name: string;
  phone: string;
  email: string;
  website: string;
  address: string;
  capital: number | null;
  num_rc: string;
  num_nif: string;
  num_statistique: string;
  num_bgfi: string;
  num_ugb: string;
  return_policy: string;
  path: File | string | null | undefined;
}
