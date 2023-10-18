<script setup lang="ts">
import { ref } from "vue";
import IngredientSelecterBox from "../../ingredient/components/IngredientSelecterBox.vue";
import { getIngredientById } from "../../ingredient/store/ingredient";
import { IngredientUser } from "../types/ingredientUser";
import { Ingredient } from "../../ingredient/types/ingredient";

const props = defineProps<{
    ingredients: IngredientUser[];
}>();

defineEmits(["submitForm"]);

const ingredients = ref([...props.ingredients]);
const amount = ref<number>();
const ingredient = ref<Ingredient>();

const ingredientSelect = (incommingIngredient: Ingredient) =>
    (ingredient.value = incommingIngredient);

const addIngredient = () => {
    if (!ingredient.value) return;
    if (!amount.value || amount.value <= 0) return;
    if (
        ingredients.value.find(
            (entry) => entry.ingredient_id === ingredient.value?.id
        )
    )
        return;
    ingredients.value.push(
        new IngredientUser(ingredient.value.id, amount.value)
    );
    amount.value = 0;
};

const removeIngredient = (id: number) => {
    const index = ingredients.value.findIndex(
        (ingredient) => ingredient.ingredient_id === id
    );
    ingredients.value.splice(index, 1);
};
</script>

<template>
    <form>
        <label id="ingredientLabel">INGREDIENTS</label>
        <IngredientSelecterBox @press-ingredient="ingredientSelect" />
        <label for="amount">AMOUNT</label><br />
        <input type="number" v-model="amount" id="amount" /><br />
        <input type="submit" @click.prevent="addIngredient" /><br />
        <label>SELECTED INGREDIENTS</label>
        <div id="selectedIngredients">
            <p v-for="ingredient in ingredients">
                {{
                    getIngredientById(ingredient.ingredient_id)?.name +
                    " " +
                    ingredient.amount
                }}
                <button
                    @click.prevent="removeIngredient(ingredient.ingredient_id)"
                >
                    REMOVE
                </button>
            </p>
        </div>
        <input
            type="submit"
            @click.prevent="$emit('submitForm', ingredients)"
        />
    </form>
</template>

<style scoped>
form {
    text-align: center;
    margin-top: 5px;
}
label {
    display: inline-block;
    margin-bottom: 5px;
}
input {
    margin-bottom: 5px;
}

#box {
    margin-bottom: 5px;
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
    margin: 10px;
    text-align: left;
}
</style>
