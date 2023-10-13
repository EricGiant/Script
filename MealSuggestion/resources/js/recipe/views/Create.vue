<script setup lang="ts">
import RecipeForm from "../components/RecipeForm.vue";
import { Recipe } from "../types/recipe";
import { createRecipe } from "../store/recipe";
import { router } from "../../router";

const recipe = new Recipe();

const submitForm = async (recipe: Recipe) => {
    await createRecipe(recipe);
    router.push({ name: "homeOverview" });
};
</script>

<template>
    <RecipeForm :recipe="recipe" @submit-form="submitForm" />
</template>
