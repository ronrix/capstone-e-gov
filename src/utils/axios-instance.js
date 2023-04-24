import axios from 'axios';

export function axiosInstance() {
  const instance = axios.create({
    headers: {
      'X-CSRF-TOKEN': localStorage.getItem("token"),
    },
  });

  return instance;
}
