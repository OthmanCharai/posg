import { Roles } from "./global/roles";

export interface Users {
  id?: string,
  first_name: string,
  last_name: string,
  email: string,
  phone_number: string,
  password: string,
  address: string,
  logo: string | null,
  role: Pick<Roles, 'id'>
}
