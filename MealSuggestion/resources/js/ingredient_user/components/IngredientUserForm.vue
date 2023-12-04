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

        <div class="col-md-12 m-auto mt-3 text-center">
            <button type="submit" class="btn btn-primary fs-4" @click.prevent="emit('submitForm', ingredients)">
                ADD
            </button>
        </div>
    </form>
</template>
