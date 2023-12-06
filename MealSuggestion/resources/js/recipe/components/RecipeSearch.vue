<script setup lang="ts">
import {computed, ref} from 'vue';

import {getRecipes, searchRecipes} from '../store/recipe';

const search = ref('');

const allRecipes = getRecipes();

const recipes = computed(() => {
    if (allRecipes.value) return searchRecipes(allRecipes.value, search.value);

    return allRecipes.value;
});
</script>

<template>
    <div class="border border-5 m-auto overflow-auto rounded" style="width: fit-content">
        <input v-model="search" type="search" placeholder="SEARCH" class="form-control rounded-0" />

        <div class="overflow-auto" style="height: fit-content; max-height: 50vh">
            <router-link
                v-for="recipe in recipes"
                :key="recipe.id"
                class="border-bottom d-block fs-5 link-dark link-underline link-underline-opacity-0 p-1 ps-2"
                :to="{name: 'recipeView', params: {recipeId: recipe.id}}"
            >
                {{ recipe.name }}
            </router-link>
        </div>
    </div>
</template>
