import axios from 'axios';

export function axiosInstance() {
  const instance = axios.create({
    headers: {
      'X-CSRF-TOKEN': localStorage.getItem("token"),
    },
  });

  // Add a request interceptor to check if the stored token has expired
  instance.interceptors.request.use(config => {
    const token = localStorage.getItem('token');
    const tokenExpiry = localStorage.getItem('tokenExpiry');

    // If there is no token, or it has expired, request a new one
    if (!token || Date.now() >= Number(tokenExpiry)) {
      return axios.get('http://localhost:8000/csrf-token', { withCredentials: true })
        .then(response => {
          localStorage.setItem('token', response.data.token);
          localStorage.setItem('tokenExpiry', Date.now() + 3600 * 1000); // set token expiry to 1 hour from now
          config.headers['X-CSRF-TOKEN'] = response.data.token; // set the new token in the request headers
          return config;
        })
        .catch(error => {
          console.error(error);
          return config; // if there's an error, just return the original config
        });
    }

    // If the token is still valid, just set it in the request headers and return the config
    config.headers['X-CSRF-TOKEN'] = token;
    return config;
  });

  return instance;
}
