<script setup lang="ts">
import type {IngredientAmount} from '@/ingredient/types/ingredientAmount';

import NavBar from '@/navbar/components/Navbar.vue';
import {router} from '@/router/index';
import {addIngredients} from '@/user/store/user';

import IngredientUserForm from '../components/IngredientUserForm.vue';

const ingredientIds: IngredientAmount[] = [];

const submitForm = async (ingredients: IngredientAmount[]) => {
    await addIngredients(ingredients);
    router.push({name: 'homeOverview'});
};
</script>

<template>
    <NavBar />

    <IngredientUserForm :ingredients="ingredientIds" @submit-form="submitForm" />
</template>
