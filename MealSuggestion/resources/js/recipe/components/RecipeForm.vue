<script setup lang="ts">
import type {Recipe} from '../types/recipe';
import type {IngredientAmount} from '@/ingredient/types/ingredientAmount';

import {ref} from 'vue';

import IngredientsSelecterBoxAmount from '@/ingredient/components/IngredientsSelecterBoxAmount.vue';

const props = defineProps<{
    recipe: Recipe;
}>();

const emit = defineEmits<{
    (event: 'submitForm', recipe: Recipe): void;
}>();

const recipe = ref({...props.recipe});

const addIngredientsToRecipe = (ingredients: IngredientAmount[]) => {
    recipe.value.ingredients = ingredients;
};
</script>

<template>
    <form>
        <label for="name">NAME</label>

        <br />

        <input id="name" v-model="recipe.name" type="text" />

        <br />

        <label for="content">CONTENT</label>

        <br />

        <textarea id="content" v-model="recipe.content" />
        >

        <br />

        <IngredientsSelecterBoxAmount @send-data="addIngredientsToRecipe" />

        <input type="submit" @click.prevent="emit('submitForm', recipe)" />
    </form>
</template>

<style>
textarea {
    margin-bottom: 5px;
    resize: none;
    width: 400px;
    height: 200px;
}
</style>
