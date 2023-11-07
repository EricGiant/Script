import axios from "axios";
import { Login } from "../pages/types/login";
import { setErrors } from "../../error/store/error";
import {
    setIngredients,
    unloadIngredients,
} from "../../ingredient/store/ingredient";
import { setCategories, unloadCategories } from "../../category/store/category";
import { setRecipes, unloadRecipes } from "../../recipe/store/recipe";
import { setUser, unloadUser } from "../../user/store/user";
import { router } from "../../router";

export const authenticateUser = async (login: Login) => {
    //does CRSF protection need to be in all submits?

    try {
        const { data } = await axios.post("/api/authenticateUser", login);
        return true;
    } catch (error: any) {
        setErrors(error);
        return false;
    }
};

export const loadAssets = async () => {
    await setIngredients();
    await setCategories();
    await setRecipes();
    await setUser();
};

export const unloadAssets = () => {
    unloadIngredients();
    unloadCategories();
    unloadRecipes();
    unloadUser();
};

export const reloadData = async () => {
    try {
        const user = await axios.get("/api/getAuthenticatedUser");
        await loadAssets();
    } catch (error) {
        router.push({ name: "loginView" });
    }
};

export const logout = async () => {
    const { data } = await axios.delete("/api/logUserOut");
};
