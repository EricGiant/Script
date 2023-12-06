<script setup lang="ts">
import {computed} from 'vue';
import {useRoute} from 'vue-router';

import Navbar from '@/navbar/components/Navbar.vue';

import RecipeInfo from '../components/RecipeInfo.vue';
import {getRecipeById, recipeMade} from '../store/recipe';

const recipeId = +useRoute().params.recipeId;
const recipe = computed(() => getRecipeById(recipeId));

const madeRecipe = () => {
    recipeMade(recipeId);
    // router.push({name: 'homeOverview'});
};
</script>

<template>
    <Navbar />

    <RecipeInfo v-if="recipe" :recipe="recipe" />

    <div class="mt-3 text-center">
        <button class="btn btn-primary fs-5" @click.prevent="madeRecipe">MADE THE RECIPE</button>
    </div>
</template>
