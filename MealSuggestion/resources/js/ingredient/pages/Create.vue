<script setup lang="ts">
import Navbar from '@/navbar/components/Navbar.vue';
import {router} from '@/router';

import IngredientForm from '../components/IngredientForm.vue';
import {storeIngredient} from '../store/ingredient';
import {Ingredient} from '../types/ingredient';

const ingredient = new Ingredient();

const submitForm = async (ingredient: Ingredient) => {
    await storeIngredient(ingredient);
    router.push({name: 'homeOverview'});
};
</script>

<template>
    <Navbar />

    <IngredientForm :ingredient="ingredient" @submit-form="submitForm" />
</template>
