<script setup lang="ts">
import type {Ingredient} from '../types/ingredient';

import {computed, ref} from 'vue';

import {getCategories} from '@/category/store/category';

import {getIngredients, searchIngredients} from '../store/ingredient';

const emit = defineEmits<{
    (event: 'pressIngredient', ingredient: Ingredient): void;
}>();

const allIngredients = getIngredients();

const ingredients = computed(() => {
    if (allIngredients.value) return searchIngredients(allIngredients.value, search.value, selectedCategoryIds.value);

    return allIngredients.value;
});

const search = ref('');

const categories = getCategories();

const displayCategoryFilterMenu = ref('none');

const filterMenuToggle = () => {
    if (displayCategoryFilterMenu.value === 'none') displayCategoryFilterMenu.value = 'block';
    else displayCategoryFilterMenu.value = 'none';
};

const selectedCategoryIds = ref<number[]>([]);

const toggleCategoryFilter = (categoryId: number) => {
    const index = selectedCategoryIds.value.findIndex(entry => entry === categoryId);
    if (index === -1) selectedCategoryIds.value.push(categoryId);
    else selectedCategoryIds.value.splice(index, 1);
};
</script>

<template>
    <div class="text-center">
        <label class="h3 mb-2 mt-2">INGREDIENTS</label>
    </div>

    <div style="width: fit-content; height: fit-content" class="border border-3 m-auto rounded">
        <div>
            <input v-model="search" class="d-inline form-control rounded-0 w-auto" type="search" placeholder="SEARCH" />

            <button class="btn btn-secondary d-inline h-100 rounded-0 w-auto" @click.prevent="filterMenuToggle">
                FILTER
            </button>
        </div>

        <div :style="{display: displayCategoryFilterMenu}" class="border border-3 overflow-y-hidden">
            <div v-for="category in categories" :key="category.id" class="h-100 overflow-y-auto text-left">
                <label :for="category.name" class="ms-1">{{ category.name }}</label>

                <input
                    :id="category.name"
                    class="ms-1"
                    type="checkbox"
                    name="categories"
                    @click="toggleCategoryFilter(category.id)"
                />
            </div>
        </div>

        <div class="border border-3 overflow-y-auto text-left" style="max-height: 150px; height: fit-content">
            <div v-for="ingredient in ingredients" :key="ingredient.id">
                <label :for="ingredient.name" class="ms-1">{{ ingredient.name }}</label>

                <input
                    :id="ingredient.name"
                    type="radio"
                    name="ingredient"
                    class="ms-1"
                    @click="emit('pressIngredient', ingredient)"
                />
            </div>
        </div>
    </div>
</template>
