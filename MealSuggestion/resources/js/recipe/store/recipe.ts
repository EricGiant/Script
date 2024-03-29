import type {Recipe} from '../types/recipe';

import axios from 'axios';
import {computed, ref} from 'vue';

import {getUser, setUser} from '@/user/store/user';

const recipes = ref<Recipe[]>();

export const setRecipes = async () => {
    const {data} = await axios.get('/api/getRecipes');
    if (!data) return;
    recipes.value = data;
};

export const unloadRecipes = () => (recipes.value = []);

export const createRecipe = async (recipe: Recipe) => {
    await axios.post('/api/storeRecipe', recipe);
    await setRecipes();
};

export const getRecipes = () => computed(() => recipes.value);

export const generateRecipeSuggestions = (ingredientIds: number[], recipeAmount = 5) => {
    if (!recipes.value) return;

    const viableRecipes = findViableRecipes(recipes.value, ingredientIds);

    if (viableRecipes.length <= recipeAmount) return viableRecipes;

    const selectedRecipes: Recipe[] = [];
    for (let index = 0; index < recipeAmount; index++) {
        let selectedRecipe = viableRecipes[Math.floor(Math.random() * viableRecipes.length)];
        while (selectedRecipes.includes(selectedRecipe))
            selectedRecipe = viableRecipes[Math.floor(Math.random() * viableRecipes.length)];
        selectedRecipes.push(selectedRecipe);
    }

    return selectedRecipes;
};

const findViableRecipes = (recipes: Recipe[], ingredientIds: number[]) => {
    const viableRecipes: Recipe[] = [];
    for (let recipeIndex = 0; recipeIndex < recipes.length; recipeIndex++) {
        const currentRecipe = recipes[recipeIndex];
        for (let ingredientIndex = 0; ingredientIndex < currentRecipe.ingredients.length; ingredientIndex++) {
            if (ingredientIds.includes(currentRecipe.ingredients[ingredientIndex].ingredientId)) {
                viableRecipes.push(currentRecipe);
                break;
            }
        }
    }

    return viableRecipes;
};

export const searchRecipes = (givenRecipes: Recipe[], search: string) =>
    givenRecipes.filter(recipe => recipe.name.toLowerCase().includes(search.toLowerCase()));

export const getRecipeById = (id: number) => recipes.value?.find(recipe => recipe.id === id);

export const recipeMade = async (recipeId: number) => {
    await axios.patch('/api/userRecipe', {recipeId});
    await setUser();
};

export const getFavoriteRecipes = (amount = 5) => {
    const user = getUser();

    if (!user.value) return;

    const sortedRecipes = [...user.value.recipes].sort((old, current) => current.amount - old.amount);

    sortedRecipes?.splice(amount - 1, sortedRecipes.length - amount);

    return sortedRecipes;
};
