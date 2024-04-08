export interface Users {
  id: string,
  first_name: string,
  last_name: string,
  email: string,
  phone_number: string,
  address: string,
  logo?: string,
  role: {
    id: string,
    name: string,
    description: string,
    permissions: number
  }
}
