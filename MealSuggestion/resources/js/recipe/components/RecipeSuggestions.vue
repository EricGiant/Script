<script setup lang="ts">
import type {Recipe} from '../types/recipe';

import {getIngredientById} from '@/ingredient/store/ingredient';

defineProps<{
    recipes: Recipe[];
}>();
</script>

<template>
    <div class="text-center">
        <span class="h3">RECIPE SUGGESTIONS</span>

        <div
            class="border border-2 m-auto mt-2 overflow-auto rounded-3"
            style="width: fit-content; max-height: 75vh; height: fit-content"
        >
            <div class="h-100 overflow-auto">
                <div v-for="recipe in recipes" :key="recipe.id" class="border-bottom p-1">
                    <div class="h6 m-0">{{ recipe.name }}</div>

                    <div v-for="ingredient in recipe.ingredients" :key="ingredient.ingredientId">
                        {{ getIngredientById(ingredient.ingredientId)?.name + ' ' + ingredient.amount }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
