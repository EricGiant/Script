<script setup lang="ts">
import type {IngredientAmount} from '@/ingredient/types/ingredientAmount';

import {ref} from 'vue';

import IngredientsSelecterBoxAmount from '@/ingredient/components/IngredientsSelecterBoxAmount.vue';

const emit = defineEmits<{
    (event: 'submitForm', ingredients: IngredientAmount[]): void;
}>();

const ingredients = ref<IngredientAmount[]>([]);

const setIngredients = (incomingIngredients: IngredientAmount[]) => (ingredients.value = incomingIngredients);
</script>

<template>
    <form>
        <IngredientsSelecterBoxAmount @send-data="setIngredients" />

        <input type="submit" @click.prevent="emit('submitForm', ingredients)" />
    </form>
</template>
