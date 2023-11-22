<script setup lang="ts">
import type {Ingredient} from '../types/ingredient';

import {ref} from 'vue';

import {IngredientAmount} from '@/ingredient/types/ingredientAmount';

import {getIngredientById} from '../store/ingredient';

import IngredientSelecterBox from './IngredientSelecterBox.vue';

const emit = defineEmits<{
    (event: 'sendData', ingredients: IngredientAmount[]): void;
}>();

const amount = ref<number>();
const selectedIngredient = ref<Ingredient>();
const selectedIngredients = ref<IngredientAmount[]>([]);

const addIngredient = () => {
    if (!selectedIngredient.value || !amount.value || amount.value <= 0) return;

    const updateIndex = selectedIngredients.value.findIndex(
        entry => entry.ingredientId === selectedIngredient.value?.id,
    );

    if (updateIndex === -1)
        selectedIngredients.value.push(new IngredientAmount(selectedIngredient.value.id, amount.value));
    else selectedIngredients.value[updateIndex].amount = amount.value;

    amount.value = 0;
    emit('sendData', selectedIngredients.value);
};

const removeIngredient = (id: number) => {
    if (!selectedIngredients.value) return;
    const index = selectedIngredients.value.findIndex(entry => entry.ingredientId === id);
    selectedIngredients.value?.splice(index, 1);
};

const addSelectedIngredient = (ingredient: Ingredient) => {
    selectedIngredient.value = ingredient;
};
</script>

<template>
    <IngredientSelecterBox @press-ingredient="addSelectedIngredient" />

    <label for="amount">AMOUNT</label>

    <br />

    <input id="amount" v-model="amount" type="number" />

    <br />

    <input type="submit" value="ADD" @click.prevent="addIngredient()" />

    <br />

    <label>SELECTED INGREDIENTS</label>

    <div id="selectedIngredients">
        <p v-for="ingredient in selectedIngredients" :key="ingredient.ingredientId">
            {{ getIngredientById(ingredient.ingredientId)?.name + ' ' + ingredient.amount }}
            <button @click.prevent="removeIngredient(ingredient.ingredientId)">REMOVE</button>
        </p>
    </div>
</template>

<style>
form {
    margin-top: 10px;
}
#selectedIngredients {
    border: 2px solid black;
    max-height: 150px;
    min-height: 75px;
    width: fit-content;
    min-width: 200px;
    margin: auto;
    margin-bottom: 5px;
    overflow-y: scroll;
}
#selectedIngredients p {
    font-size: 16px;
    text-align: left;
    margin: 10px;
}
#box {
    margin-bottom: 10px !important;
}
#selectedIngredients {
    margin-bottom: 10px;
}
input[type='number'] {
    margin-bottom: 10px;
}
input[type='submit'] {
    margin-bottom: 10px;
}
</style>
