<script setup lang="ts">
import type {Ingredient} from '../types/ingredient';

import {computed, ref} from 'vue';

import {searchIngredients} from '../store/ingredient';

const emit = defineEmits<{
    (event: 'pressIngredient', ingredient: Ingredient): void;
}>();

const ingredients = computed(() => searchIngredients(search.value));
const search = ref('');
</script>

<template>
    <label>INGREDIENTS</label>

    <div id="box">
        <input v-model="search" type="text" placeholder="SEARCH" />

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
    font-size: 14px;
    margin-bottom: 0px;
}
#content {
    overflow-y: scroll;
    max-height: 120px;
}
#content label {
    padding-left: 5px;
}
</style>
