<script setup lang="ts">
import Navbar from '@/navbar/components/Navbar.vue';
import {router} from '@/router';

import RecipeForm from '../components/RecipeForm.vue';
import {createRecipe} from '../store/recipe';
import {Recipe} from '../types/recipe';

const recipe = new Recipe();

const submitForm = async (recipe: Recipe) => {
    await createRecipe(recipe);
    router.push({name: 'homeOverview'});
};
</script>

<template>
    <Navbar />

    <RecipeForm :recipe="recipe" @submit-form="submitForm" />
</template>
