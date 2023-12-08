<script setup lang="ts">
import {computed} from 'vue';

import Navbar from '@/navbar/components/Navbar.vue';
import RecipeFavorite from '@/recipe/components/RecipeFavorite.vue';
import {getFavoriteRecipes} from '@/recipe/store/recipe';

const recipes = computed(() => getFavoriteRecipes());
</script>

<template>
    <Navbar />

    <RecipeFavorite v-if="recipes" :recipes="recipes" />
</template>
