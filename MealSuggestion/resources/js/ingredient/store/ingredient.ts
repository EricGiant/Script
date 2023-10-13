import { ref } from "vue";
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
    if (!data) return;
    getAllIngredients();
};
