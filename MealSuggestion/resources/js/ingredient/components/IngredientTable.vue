<script setup lang="ts">
import type {IngredientAmount} from '../types/ingredientAmount';
import type {IngredientTable} from '../types/ingredientTable';

import {computed} from 'vue';

import {getIngredientById} from '../store/ingredient';

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
    <div class="border border-5 container rounded text-center" style="width: fit-content; height: fit-content">
        <div class="border-5 border-bottom h3 mb-0 row">
            <div class="col-sm">INGREDIENT</div>

            <div class="col-sm">AMOUNT</div>
        </div>

        <div v-for="ingredient in ingredients" :key="ingredient.ingredientId" class="row">
            <div class="col-sm-3">{{ getIngredientById(ingredient.ingredientId)?.name }}</div>

            <div v-if="!ingredient.editable" class="col-sm-3">{{ ingredient.amount }}</div>

            <div v-if="ingredient.editable" class="col-sm-6 p-0">
                <input
                    v-model="ingredient.amount"
                    type="number"
                    class="border-2 d-inline form-control rounded-0 w-50"
                />

                <button
                    class="btn btn-primary btn-sm h-100 rounded-0 w-50"
                    style="margin-top: -4px"
                    @click.prevent="saveEdit(ingredient)"
                >
                    <!-- temp fix by doing -4 to mt this mostly fixed it visually, fix it for real with help because this issue is also on other parts of the site -->
                    SAVE
                </button>
            </div>

            <button
                v-if="!ingredient.editable"
                class="btn btn-info col-sm-3 p-0 rounded-0 text-white"
                @click.prevent="ingredient.editable = !ingredient.editable"
            >
                EDIT
            </button>

            <button
                class="btn btn-danger col-sm-3 p-0 rounded-0"
                @click.prevent="emit('deleteIngredient', ingredient.ingredientId)"
            >
                DELETE
            </button>
        </div>
    </div>
</template>
