axios.defaults.baseURL = window.origin;
axios.defaults.headers.common['Authorization'] = window.localStorage.getItem('csrf_token');