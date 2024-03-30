import type { FormError } from '@common/types/global/form-errors';
import { Toast } from "@/src/utils/toast";

const errors = reactive<FormError>({});

const initializeErrors = (): void => {
  for (const key in errors) {
      delete errors[key];
  }
};

export const processErrors = (error: any, errorMessage: Ref<string>): void => {
  initializeErrors(); // Reset errors
  if(error.response.data.errors) {
    for (const key in error.response.data.errors) {
      errors[key] = error.response.data.errors[key];
    }
  }

  if(error.response.data.message) {
    errorMessage.value = error.response.data.message;

    Toast.error(error.response.data.message);
  } else {

    Toast.error('Une erreur est survenue !');
  }
};

/**
 * Display error message
 * @param field - field name
 */
export const getErrorMessage = (field: string): string | '' => {
  if (errors[field] && errors[field].length > 0) {
      return errors[field][0];
  }
  return ''; // return an empty string if no errors
};

/**
 * Check if error exist on field
 * @param field - field name
 */
export const hasError = (field: string): boolean => {
    return Boolean(errors[field]);
};

/**
 * Clear error from field
 * @param field - field name
 */
export const clearError = (field: string): void => {
    if (errors[field]) {
        delete errors[field];
    }
};

/**
 * Can be used to debug errors or to add more customization on errors object
 */
export const useErrors = () => {
  return errors;
};

/**
 * Add custom error from the front-end
 * @param field - field name
 * @param message - error massage to display
 */
export const addError = (field: string, message: string) => {
  if (errors[field]) {
    errors[field].push(message);
  } else {
    errors[field] = [message];
  }
}
