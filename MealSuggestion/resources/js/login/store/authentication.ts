import type {Login} from '../types/login';

import axios from 'axios';

import {setCategories, unloadCategories} from '@/category/store/category';
import {setErrors} from '@/error/store/error';
import {setIngredients, unloadIngredients} from '@/ingredient/store/ingredient';
import {setRecipes, unloadRecipes} from '@/recipe/store/recipe';
import {router} from '@/router';
import {setUser, unloadUser} from '@/user/store/user';

export const authenticateUser = async (login: Login) => {
    try {
        await axios.post('/api/authenticateUser', login);

        return true;
    } catch (error: unknown) {
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
    try {
        await loadAssets();
    } catch (error) {
        router.push({name: 'loginView'});
    }
};

export const logout = async () => {
    await axios.delete('/api/logUserOut');
};
