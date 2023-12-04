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

    <div class="col-sm-2 m-auto mb-2 mt-2 text-center">
        <label class="h3">AMOUNT</label>

        <input id="amount" v-model="amount" type="number" class="form-control m-auto w-50" />
    </div>

    <div class="m-auto text-center">
        <input type="submit" value="ADD" class="btn btn-primary" @click.prevent="addIngredient()" />
    </div>

    <div class="text-center">
        <label class="h3 mb-2 mt-2">SELECTED INGREDIENTS</label>
    </div>

    <div
        class="border border-3 m-auto overflow-y-auto rounded"
        style="min-width: 200px; height: 100px; width: fit-content"
    >
        <div class="d-inline h-100 overflow-y-auto text-left">
            <div v-for="ingredient in selectedIngredients" :key="ingredient.ingredientId" class="clearfix ms-1">
                <label class="me-1 w-auto">
                    {{ getIngredientById(ingredient.ingredientId)?.name + ' ' + ingredient.amount }}
                </label>

                <button
                    class="btn btn-danger btn-sm float-end rounded-0 w-auto"
                    @click.prevent="removeIngredient(ingredient.ingredientId)"
                >
                    REMOVE
                </button>
            </div>
        </div>
    </div>
</template>
