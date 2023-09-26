import { computed, ref } from "vue";
import { Error } from "../types/error"
import { AxiosResponse } from "axios";

const error = ref<Error>();

export const setError = (response: AxiosResponse) => error.value = {code: response.status, message: response.data.message};
export const getError = () => computed(() => error.value);