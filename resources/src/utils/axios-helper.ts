import type { AxiosRequestConfig, AxiosResponse } from 'axios';
import axios from './http';
import { processErrors } from '@utils/error-handler';
import { ref } from 'vue';

// ziggy route caller
export const route = window.route;

/**
 * composable function for axios requests with reactive state
 */
export const useAxios = () => {
  const loading = ref(false);
  const response = ref<AxiosResponse<any>>();
  const errorMessage = ref<string>('');

  const request = async (config: AxiosRequestConfig) => {
    response.value = undefined; // clear response before lunching any request
    loading.value = true;
    try {
      const result = await axios(config);
      if (result.status >= 200 && result.status < 300) {
        response.value = result;
      }
    } catch (err: any) {
      processErrors(err, errorMessage);
    } finally {
      loading.value = false;
    }
  };

  return { loading, response, errorMessage, request };
};
