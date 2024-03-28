import axios from 'axios';

axios.defaults.headers.common = {
  'X-Requested-With': 'XMLHttpRequest',
  withCredentials: true,
};

axios.interceptors.request.use((config) => {
  if (config.method === 'get') {
    config = {
      ...config,
      // eslint-disable-next-line @typescript-eslint/no-unsafe-assignment
      params: {
        ...config.params,
        t: Date.now(),
      },
    };
  }

  return config;
});

export default axios;
