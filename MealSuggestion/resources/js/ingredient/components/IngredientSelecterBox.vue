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

const displayValue = ref('none');

const filterMenuToggle = () => {
    if (displayValue.value === 'none') displayValue.value = 'block';
    else displayValue.value = 'none';
};

const selectedCategoryIds = ref<number[]>([]);

const toggleCategoryFilter = (categoryId: number) => {
    const index = selectedCategoryIds.value.findIndex(entry => entry === categoryId);
    if (index === -1) selectedCategoryIds.value.push(categoryId);
    else selectedCategoryIds.value.splice(index, 1);
};
</script>

<template>
    <label>INGREDIENTS</label>

    <div id="box">
        <input v-model="search" type="text" placeholder="SEARCH" />

        <button id="filterButton" @click.prevent="filterMenuToggle">FILTER</button>

        <div id="filterMenu" :style="{display: displayValue}">
            <div v-for="category in categories" :key="category.id">
                <label :for="category.name">{{ category.name }}</label>

                <input
                    :id="category.name"
                    type="checkbox"
                    name="categories"
                    @click="toggleCategoryFilter(category.id)"
                />
            </div>
        </div>

        <div id="content">
            <div v-for="ingredient in ingredients" :key="ingredient.id">
                <label :for="ingredient.name">{{ ingredient.name }}</label>

                <input
                    :id="ingredient.name"
                    type="radio"
                    name="ingredient"
                    @click="emit('pressIngredient', ingredient)"
                />
            </div>
        </div>
    </div>
</template>

<style scoped>
#box {
    height: fit-content;
    width: fit-content;
    margin: auto;
    border: 2px solid black;
    text-align: left;
    font-size: 0; /* this is to fix the random whitespace that now appears between the box and the input search because of a recent chrome update this started to happen */
}
input[type='text'] {
    overflow: hidden;
    outline: none;
    border: 1px solid black;
    border-top: none;
    font-size: 14px;
    margin-bottom: 0px;
}
#filterButton {
    border: none;
    background-color: white;
    border-bottom: 1px solid black;
}
#filterMenu {
    padding-left: 5px;
    padding-bottom: 3px;
}
#content {
    overflow-y: scroll;
    max-height: 120px;
    border: 1px solid black;
}
#content label {
    padding-left: 5px;
}
</style>
