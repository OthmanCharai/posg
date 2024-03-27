import Swal from 'sweetalert2';
import type { SweetAlertToasts } from '@common/types/toasts';

const BaseToast = Swal.mixin({
  toast: true,
  position: 'bottom-right',
  iconColor: 'white',
  customClass: {
    popup: 'colored-toast',
  },
  showConfirmButton: false,
  showCloseButton: true,
  timer: 3000,
  timerProgressBar: true,
});

export const Toast: SweetAlertToasts = {
  success: (title: string) => BaseToast.fire({ icon: 'success', title }),
  error: (title: string) => BaseToast.fire({ icon: 'error', title }),
  warning: (title: string) => BaseToast.fire({ icon: 'warning', title }),
  info: (title: string) => BaseToast.fire({ icon: 'info', title }),
  question: (title: string) => BaseToast.fire({ icon: 'question', title }),
};
