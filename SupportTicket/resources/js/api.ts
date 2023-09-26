import axios, { AxiosError, AxiosResponse } from "axios";
import { setError } from "./error/store/error";

const api = axios.create({
    headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
    },
});

// Add a response interceptor
api.interceptors.response.use(
    function (response: AxiosResponse) {
        // Any status code that lie within the range of 2xx cause this function to trigger
        // Do something with response data
        return response;
    },
    function (error: AxiosError) {
        // Any status codes that falls outside the range of 2xx cause this function to trigger
        // Do something with response error
        setError(error.response);
        // TODO:
        // dispatch de error melding naar de error store
        // de error store map je weer via een getter naar de pages components
        return Promise.reject(error);
    }
);

export default api;