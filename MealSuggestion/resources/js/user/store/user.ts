import { computed, ref } from "vue";
import { User } from "../types/user";
import axios from "axios";
import { IngredientUser } from "../../ingredient_user/types/ingredientUser";

const user = ref<User>();

export const setUser = async () => {
    const { data } = await axios.get("/api/getAuthenticatedUser");
    user.value = data;
};

export const unloadUser = () => (user.value = new User());

export const addIngredients = async (ingredients: IngredientUser[]) => {
    const { data } = await axios.post("/api/addIngredients", ingredients);
    setUser();
};
