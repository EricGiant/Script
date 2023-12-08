<script setup lang="ts">
import type {RecipeAmount} from '../types/recipeAmount';

import {getRecipeById} from '../store/recipe';

defineProps<{
    recipes: RecipeAmount[];
}>();
</script>

<template>
    <div class="m-auto mt-3" style="width: fit-content">
        <div class="h3 text-center">YOUR FAVORITE RECIPES</div>

        <div v-for="recipe in recipes" :key="recipe.recipeId">
            <div>U Made {{ getRecipeById(recipe.recipeId)?.name + ' ' + recipe.amount }} Times</div>
        </div>
    </div>
</template>
