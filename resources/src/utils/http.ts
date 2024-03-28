import axios from 'axios';

axios.defaults.headers.common = {
  'X-Requested-With': 'XMLHttpRequest',
  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
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
