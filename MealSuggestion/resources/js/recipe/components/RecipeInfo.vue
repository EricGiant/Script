<script setup lang="ts">
import type {Recipe} from '../types/recipe';

import {getIngredientById} from '@/ingredient/store/ingredient';

defineProps<{
    recipe: Recipe;
}>();
</script>

<template>
    <div class="align-items-center col-sm-8 d-flex flex-column m-auto">
        <div class="h2">{{ recipe.name }}</div>

        <div class="h6">INGREDIENTS</div>

        <div>
            <div
                v-for="ingredient in recipe.ingredients"
                :key="ingredient.ingredientId"
                class="d-flex justify-content-between"
            >
                <span>{{ getIngredientById(ingredient.ingredientId)?.name }}</span>

                <span class="ms-2">{{ ingredient.amount }}</span>
            </div>
        </div>

        <div class="h6 mt-2">HOW TO MAKE</div>

        <div class="w-75">{{ recipe.content }}</div>
    </div>
</template>
