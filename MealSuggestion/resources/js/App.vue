<script setup lang="ts">
//temporarily load all assets here
import { onMounted } from "vue";
import { setIngredients } from "./ingredient/store/ingredient";
import { setCategories } from "./category/store/category";
import { setRecipes } from "./recipe/store/recipe";
import { setUser } from "./user/store/user";

onMounted(async () => {
    await setIngredients();
    await setCategories();
    await setRecipes();
    await setUser();
});
</script>

<template>
    <router-view />
</template>
