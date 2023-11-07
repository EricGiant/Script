import { ref } from "vue";
import { Error } from "../types/error";

const errors = ref<Error[]>();

export const setErrors = (incommingErrors: any) => {
    errors.value = [];

    for (const error in incommingErrors?.response?.data?.errors) {
        errors.value.push(
            new Error(incommingErrors.response.data.errors[error])
        );
    }
};

export const getErrorsAsSingleString = () => {
    let string = "";
    if (errors.value) {
        for (let i = 0; i < errors.value?.length; i++) {
            string += errors.value[i].message;
            string += "\n";
        }
    }

    return string;
};
