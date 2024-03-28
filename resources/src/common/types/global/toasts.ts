import { SweetAlertResult } from 'sweetalert2';

export interface SweetAlertToasts {
  success: (title: string) => Promise<SweetAlertResult<any>>;
  error: (title: string) => Promise<SweetAlertResult<any>>;
  warning: (title: string) => Promise<SweetAlertResult<any>>;
  info: (title: string) => Promise<SweetAlertResult<any>>;
  question: (title: string) => Promise<SweetAlertResult<any>>;
}
