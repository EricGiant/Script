import type {UserAccount} from '../types/userAccount';
import type {IngredientAmount} from '@/ingredient/types/ingredientAmount';

import axios from 'axios';
import {computed, ref} from 'vue';

import {User} from '../types/user';

const user = ref<User>();

export const setUser = async () => {
    const {data} = await axios.get('/api/getAuthenticatedUser');
    user.value = data;
};

export const unloadUser = () => (user.value = new User());

export const addIngredients = async (ingredients: IngredientAmount[]) => {
    await axios.post('/api/addUserIngredients', ingredients);
    await setUser();
};

export const updateIngredient = async (ingredient: IngredientAmount) => {
    await axios.patch('/api/updateUserIngredient', ingredient);
    await setUser();
};

export const getUser = () => computed(() => user.value);

export const deleteIngredient = async (id: number) => {
    await axios.delete('/api/deleteUserIngredient', {data: {id}});
    await setUser();
};

export const createUser = async (userAccount: UserAccount) => {
    await axios.post('/api/createUser', userAccount);
};

export const updateUserPassword = async (password: string, token: string) => {
    await axios.patch('/api/updateUserPassword', {password, token});
};
