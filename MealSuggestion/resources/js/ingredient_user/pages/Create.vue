<script setup lang="ts">
import type {IngredientAmount} from '@/ingredient/types/ingredientAmount';

import {ref} from 'vue';

import NavBar from '@/navbar/components/Navbar.vue';
import RecipeSuggestions from '@/recipe/components/RecipeSuggestions.vue';
import {generateRecipeSuggestions} from '@/recipe/store/recipe';
import {addIngredients, getUser} from '@/user/store/user';

import IngredientUserForm from '../components/IngredientUserForm.vue';

const ingredientIds: IngredientAmount[] = [];

const showRecipeSuggestions = ref(false);
const suggestedRecipes = ref(); // for now type any

const submitForm = async (ingredients: IngredientAmount[]) => {
    await addIngredients(ingredients);

    const ingredientIds: number[] = [];
    getUser().value?.ingredients.forEach(ingredient => ingredientIds.push(ingredient.ingredientId));

    suggestedRecipes.value = generateRecipeSuggestions(ingredientIds);

    showRecipeSuggestions.value = true;
};
</script>

<template>
    <NavBar />

    <IngredientUserForm v-if="!showRecipeSuggestions" :ingredients="ingredientIds" @submit-form="submitForm" />

    <RecipeSuggestions v-if="showRecipeSuggestions" :recipes="suggestedRecipes" />

    <div v-if="showRecipeSuggestions" class="text-center">
        <router-link :to="{name: 'homeOverview'}" class="btn btn-primary fs-5 mt-3">TO HOME PAGE</router-link>
    </div>
</template>
