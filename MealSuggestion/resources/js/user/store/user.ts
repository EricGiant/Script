import type {IngredientAmount} from '@/ingredient/types/ingredientAmount';

import axios from 'axios';
import {ref} from 'vue';

import {User} from '../types/user';

const user = ref<User>();

export const setUser = async () => {
    const {data} = await axios.get('/api/getAuthenticatedUser');
    user.value = data;
};

export const unloadUser = () => (user.value = new User());

export const addIngredients = async (ingredients: IngredientAmount[]) => {
    await axios.post('/api/addIngredients', ingredients);
    setUser();
};
