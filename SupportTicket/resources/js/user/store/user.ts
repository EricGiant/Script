import { computed, ref } from "vue";
import { IUser, User } from "../types/user";
import axios from "../../api";
import { router } from "../../router";
import { loadAssets } from "../../login/store/authentication";

const user = ref<IUser>();

export const getUser = () => computed(() => user.value);
export const setUser = (info: IUser) => (user.value = info);
export const removeUserStore = () => (user.value = new User());
export const getLoggedInUser = async () => {
    const { data } = await axios.get("/api/authenticate/getLoggedInUser");
    // TODO: laat controller een error (4xx code) maken zodat je met try en catch kunt werken
    if (data == "noLogin") {
        if (router.currentRoute.value.name == "loginEdit") {
            return;
        }
        router.push({ name: "login" });
    } else {
        loadAssets(data);
        user.value = data;
    }
};
