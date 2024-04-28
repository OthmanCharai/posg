import axios from 'axios';

axios.defaults.headers.common = {
  'X-Requested-With': 'XMLHttpRequest',
  withCredentials: true,
};

axios.interceptors.request.use((config) => {
  return config
})

axios.interceptors.response.use((response) => {
  return response;
}, (error) => {
  if (error.response?.status === 401 || error.response?.status === 403 || error.response?.status === 419) {
    if (location.pathname !== '/login') {
      location.assign('/login');
    }
  }

  return Promise.reject(error);
})

export default axios;
