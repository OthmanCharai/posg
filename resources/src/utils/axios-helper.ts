import type {AxiosRequestConfig, AxiosResponse} from 'axios';
import axios from "./http";
import {processErrors} from '@utils/error-handler';
import {ref} from 'vue';

// ziggy route caller
export const route = window.route;

/**
 * composable function for axios requests with reactive state
 */
export const useAxios = () => {
    const loading = ref(false);
    const response = ref<AxiosResponse<any>>();
    const errorMessage = ref<string>('');
    const status = ref<number>();

    const request = async (config: AxiosRequestConfig) => {
        loading.value = true;
        try {
            response.value = await axios(config);
            status.value = response.value?.status
        } catch (err: any) {
            response.value = err;
            status.value = err.response.status;
            processErrors(err, errorMessage);

        } finally {
            loading.value = false;
        }
    };

    return {loading, response, errorMessage, request, status};
};

