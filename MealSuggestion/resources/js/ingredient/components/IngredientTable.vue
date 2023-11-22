<script setup lang="ts">
import type {IngredientAmount} from '../types/ingredientAmount';
import type {IngredientTable} from '../types/ingredientTable';

import {computed} from 'vue';

import {getIngredientById} from '@/ingredient/store/ingredient';

const props = defineProps<{
    ingredients: IngredientAmount[];
}>();

const emit = defineEmits<{
    (event: 'updateIngredient', ingredient: IngredientAmount): void;
    (event: 'deleteIngredient', id: number): void;
}>();

const ingredients = computed<IngredientTable[]>(() => <IngredientTable[]>[...props.ingredients]);

const saveEdit = (ingredient: IngredientTable) => {
    emit('updateIngredient', ingredient);

    const index = ingredients.value.findIndex(
        currentIngredient => currentIngredient.ingredientId === ingredient.ingredientId,
    );

    ingredients.value[index].editable = false;
};
</script>

<template>
    <table>
        <tr>
            <th>INGREDIENT</th>

            <th>AMOUNT</th>
        </tr>

        <tr v-for="ingredient in ingredients" :key="ingredient.ingredientId">
            <td>{{ getIngredientById(ingredient.ingredientId)?.name }}</td>

            <td>
                <span v-if="!ingredient.editable">{{ ingredient.amount }}</span>

                <div v-if="ingredient.editable">
                    <input v-model="ingredient.amount" type="number" class="inputAmount" />

                    <button class="save" @click.prevent="saveEdit(ingredient)">SAVE</button>
                </div>
            </td>

            <button
                v-if="!ingredient.editable"
                class="edit"
                @click.prevent="ingredient.editable = !ingredient.editable"
            >
                EDIT
            </button>

            <button @click.prevent="emit('deleteIngredient', ingredient.ingredientId)">DELETE</button>
        </tr>
    </table>
</template>

<style>
table {
    margin: auto;
    margin-top: 5px;
    text-align: center;
}
th {
    padding: 5px;
}
.inputAmount {
    margin-right: 10px;
}
.save {
    margin-right: 10px;
}
.edit {
    margin-right: 10px;
}
</style>
