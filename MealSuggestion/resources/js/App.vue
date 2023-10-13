<script setup lang="ts">
//temporarily load all assets here
import { onMounted } from "vue";
import { getAllIngredients } from "./ingredient/store/ingredient";
import { getAllCategories } from "./category/store/category";

onMounted(async () => {
    await getAllIngredients();
    await getAllCategories();
});
</script>

<template>
    <router-view />
</template>
