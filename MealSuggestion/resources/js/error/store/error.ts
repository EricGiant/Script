import {ref} from 'vue';

import {Error} from '../types/error';

const errors = ref<Error[]>();

// any is required here because unknown would break the loop for getting the errors
// eslint-disable-next-line @typescript-eslint/no-explicit-any
export const setErrors = (incommingErrors: any) => {
    errors.value = [];

    for (const error in incommingErrors?.response?.data?.errors)
        errors.value.push(new Error(incommingErrors.response.data.errors[error]));
};

export const getErrorsAsSingleString = () => {
    let string = '';
    if (errors.value) {
        for (let index = 0; index < errors.value?.length; index++) {
            // TODO: als je toch al een aparte Error class hebt, zou ik er een toString method
            // aan toevoegen zodat je elegant onderstaande string kunt opvragen en de logica
            // hiervoor niet in deze error store, maar in de Error class zelf herbergt
            string += errors.value[index].message;
            string += '\n';
        }
    }

    return string;
};
