<script setup lang="ts">
import IngredientSelecterBox from "../../ingredient/components/IngredientSelecterBox.vue";
import { Ingredient } from "../../ingredient/types/ingredient";
import { Recipe } from "../types/recipe";
import { getIngredientById } from "../../ingredient/store/ingredient";
import { ref } from "vue";
import { Input } from "postcss";
import Navbar from "../../navbar/components/Navbar.vue";

const props = defineProps<{
    recipe: Recipe;
}>();

defineEmits(["submitForm"]);

const recipe = ref({ ...props.recipe });
const amount = ref<number>();
const ingredient = ref<Ingredient>();

const ingredientSelect = (incommingIngredient: Ingredient) =>
    (ingredient.value = incommingIngredient);

const addIngredient = () => {
    if (!ingredient.value) return;
    if (amount.value === 0 || !amount.value) return;
    if (
        recipe.value.ingredients.find(
            (recipeIngredient) => recipeIngredient.id === ingredient.value?.id
        )
    )
        return;
    recipe.value.ingredients.push({
        id: ingredient.value.id,
        amount: amount.value,
    });
    amount.value = 0;
};

const removeIngredient = (id: number) => {
    const index = recipe.value.ingredients.findIndex(
        (ingredient) => ingredient.id === id
    );
    recipe.value.ingredients.splice(index, 1);
};
</script>

<template>
    <Navbar />
    <form>
        <label for="name">NAME</label><br />
        <input type="text" v-model="recipe.name" id="name" /><br />
        <label for="content">CONTENT</label><br />
        <textarea id="content" v-model="recipe.content"></textarea><br />
        <label id="ingredientLabel">INGREDIENTS</label>
        <IngredientSelecterBox @press-ingredient="ingredientSelect" />
        <label for="amount">AMOUNT</label><br />
        <input type="number" v-model="amount" id="amount" /><br />
        <input type="submit" @click.prevent="addIngredient" /><br />
        <label>SELECTED INGREDIENTS</label>
        <div id="selectedIngredients">
            <p v-for="ingredient in recipe.ingredients">
                {{
                    getIngredientById(ingredient.id)?.name +
                    " " +
                    ingredient.amount
                }}
                <button @click.prevent="removeIngredient(ingredient.id)">
                    REMOVE
                </button>
            </p>
        </div>
        <input type="submit" @click.prevent="$emit('submitForm', recipe)" />
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

textarea {
    margin-bottom: 5px;
    resize: none;
    width: 400px;
    height: 200px;
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
