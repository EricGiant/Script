import type {Login} from '../types/login';

import axios from 'axios';

import {setCategories, unloadCategories} from '@/category/store/category';
import {getErrorsAsSingleString, setErrors} from '@/error/store/error';
import {setIngredients, unloadIngredients} from '@/ingredient/store/ingredient';
import {setRecipes, unloadRecipes} from '@/recipe/store/recipe';
import {router} from '@/router';
import {setUser, unloadUser} from '@/user/store/user';

export const authenticateUser = async (login: Login) => {
    try {
        await axios.post('/api/authenticateUser', login);

        return true;
    } catch (error) {
        // TODO: errors via axios interceptor dispatchen naar error store, scheelt veel
        // extra error dispatch code in store modules
        // en in dit catch blok een toast message met error weergeven
        setErrors(error);

        return false;
    }
};

export const loadAssets = async () => {
    await setUser();
    await setIngredients();
    await setCategories();
    await setRecipes();
};

export const unloadAssets = () => {
    unloadIngredients();
    unloadCategories();
    unloadRecipes();
    unloadUser();
};

export const reloadData = async () => {
    await router.isReady();

    if (router.currentRoute.value.name === 'loginEdit') return;

    try {
        await loadAssets();
    } catch (error) {
        router.push({name: 'loginView'});
    }
};

export const logout = async () => {
    await axios.delete('/api/logUserOut');
};

export const logUserIn = async (login: Login) => {
    const data = await authenticateUser(login);
    if (data) {
        await loadAssets();
        router.push({name: 'homeOverview'});
        // eslint-disable-next-line no-alert
    } else if (!data) alert(getErrorsAsSingleString());
};

export const forgotPassword = async (email: string) => {
    await axios.post('/api/forgotPassword', {email});
};
