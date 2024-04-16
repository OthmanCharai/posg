export interface Users {
  id?: string,
  first_name: string,
  last_name: string,
  email: string,
  phone_number: string,
  password: string,
  address: string,
  logo: File | string | null | undefined,
  role_id: string
}
