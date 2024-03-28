import type { AxiosRequestConfig, AxiosResponse } from 'axios';
import axios from "./http";
import { processErrors } from '@utils/error-handler';

// ziggy route caller
export const route = window.route;

/**
 * composable function for axios requests with reactive state
 * @returns {Object} { loading, response, errorMessage, request }
 */
export const useAxios = (): object => {
  const loading = ref(false);
  const response = ref<AxiosResponse<any>>();
  const errorMessage = ref<string>('');

  const request = async (config: AxiosRequestConfig) => {
      loading.value = true;
      try {
          response.value = await axios(config);
      } catch (err: any) {
          processErrors(err, errorMessage);
      } finally {
          loading.value = false;
      }
  };

  return { loading, response, errorMessage, request };
};

