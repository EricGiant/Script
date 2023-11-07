import { ref } from "vue";
import { Recipe } from "../types/recipe";
import axios from "axios";

const recipes = ref<Recipe[]>();

export const setRecipes = async () => {
    const { data } = await axios.get("/api/getRecipes");
    if (!data) return;
    recipes.value = data;
};

export const unloadRecipes = () => (recipes.value = []);

export const createRecipe = async (recipe: Recipe) => {
    const { data } = await axios.post("/api/storeRecipe", recipe);
    await setRecipes();
};
