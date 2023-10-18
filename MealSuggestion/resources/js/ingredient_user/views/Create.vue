<script setup lang="ts">
import { router } from "../../router";
import IngredientUserForm from "../components/IngredientUserForm.vue";
import { IngredientUser } from "../types/ingredientUser";
import { addIngredients } from "../../user/store/user";
import NavBar from "../../navbar/components/Navbar.vue";

const ingredientIds: IngredientUser[] = [];

const submitForm = async (ingredients: IngredientUser[]) => {
    await addIngredients(ingredients);
    router.push({ name: "homeOverview" });
};
</script>

<template>
    <NavBar />
    <IngredientUserForm
        :ingredients="ingredientIds"
        @submit-form="submitForm"
    />
</template>
