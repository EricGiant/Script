<script setup lang="ts">
//temporarily load all assets here
import { onMounted } from "vue";
import { getAllIngredients } from "./ingredient/store/ingredient";
import { getAllCategories } from "./category/store/category";
import { getAllRecipes } from "./recipe/store/recipe";
import { getAllUsers } from "./user/store/user";

onMounted(async () => {
    await getAllIngredients();
    await getAllCategories();
    await getAllRecipes();
    await getAllUsers();
});
</script>

<template>
    <router-view />
</template>
