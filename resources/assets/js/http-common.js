import axios from "axios";
const token = localStorage.getItem("token") || '';
export const HTTP = axios.create({
  baseURL: `http://localhost/vuelaravelcrud/public/api/`,
  headers: {
    Authorization: 'Bearer '+token
  }
});
