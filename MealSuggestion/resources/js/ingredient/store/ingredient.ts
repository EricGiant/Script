import { computed, ref } from "vue";
import { Ingredient } from "../types/ingredient";
import axios from "axios";

const ingredients = ref<Ingredient[]>();

export const getAllIngredients = async () => {
    const { data } = await axios.get("/api/getIngredients");
    if (!data) return;
    ingredients.value = data;
};

export const storeIngredient = async (ingredient: Ingredient) => {
    const { data } = await axios.post("/api/storeIngredient", ingredient);
    await getAllIngredients();
};

export const getIngredients = () => computed(() => ingredients.value);

export const searchIngredients = (search: string) => {
    if (!ingredients.value) return;
    if (!search) return ingredients.value;
    return [...ingredients.value].filter((ingredients) =>
        ingredients.name.toLowerCase().includes(search.toLowerCase())
    );
};

export const getIngredientById = (id: number) =>
    ingredients.value?.find((ingredient) => ingredient.id === id);
