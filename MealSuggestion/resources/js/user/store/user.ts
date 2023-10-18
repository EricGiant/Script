import { ref } from "vue";
import { User } from "../types/user";
import axios from "axios";
import { IngredientUser } from "../../ingredient_user/types/ingredientUser";

const user = ref<User>();

export const getAllUsers = async () => {
    const { data } = await axios.get("/api/getUsers");
};

export const addIngredients = async (ingredients: IngredientUser[]) => {
    const { data } = await axios.post("/api/addIngredients", ingredients);
    getAllUsers();
};
