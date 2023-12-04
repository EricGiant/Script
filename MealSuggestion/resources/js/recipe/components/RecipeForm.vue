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
        <div class="col-sm-3 m-auto text-center">
            <label for="name" class="h3">NAME</label>

            <input id="name" v-model="recipe.name" type="text" class="form-control" />
        </div>

        <div class="col-sm-6 m-auto text-center">
            <label for="content" class="h3">CONTENT</label>

            <textarea
                id="content"
                v-model="recipe.content"
                class="form-control overflow-hidden"
                style="resize: none; height: 200px"
            />
        </div>

        <IngredientsSelecterBoxAmount @send-data="addIngredientsToRecipe" />

        <div class="mt-3 text-center">
            <button type="submit" class="btn btn-primary fs-4" @click.prevent="emit('submitForm', recipe)">ADD</button>
        </div>
    </form>
</template>
