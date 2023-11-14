import type {Ingredient} from '../types/ingredient';

import axios from 'axios';
import {computed, ref} from 'vue';

const ingredients = ref<Ingredient[]>();

export const setIngredients = async () => {
    const {data} = await axios.get('/api/getIngredients');
    if (!data) return;
    ingredients.value = data;
};

export const unloadIngredients = () => (ingredients.value = []);

export const storeIngredient = async (ingredient: Ingredient) => {
    await axios.post('/api/storeIngredient', {name: ingredient.name, category_id: ingredient.categoryId});
    await setIngredients();
};

export const getIngredients = () => computed(() => ingredients.value);

// eslint-disable-next-line complexity
export const searchIngredients = (search: string, categoryFilterIds: number[]) => {
    if (!search && categoryFilterIds.length === 0) return ingredients.value;
    if (!search && categoryFilterIds.length !== 0)
        return ingredients.value?.filter(ingredient => categoryFilterIds.includes(ingredient.categoryId));
    if (search && categoryFilterIds.length === 0)
        return ingredients.value?.filter(ingredient => ingredient.name.toLowerCase().includes(search.toLowerCase()));

    return ingredients.value
        ?.filter(ingredient => categoryFilterIds.includes(ingredient.categoryId))
        .filter(ingredient => ingredient.name.toLowerCase().includes(search.toLowerCase()));
};

export const getIngredientById = (id: number) => ingredients.value?.find(ingredient => ingredient.id === id);
