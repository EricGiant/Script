import { computed, ref } from "vue";
import { IUser, User } from "../types/user";
import axios from "../../api";
import { router } from "../../router";
import { getAllNotes } from "../../note/store/note";
import { getAllTickets } from "../../ticket/store/ticket";
import { getAllStatuses } from "../../status/store/status";
import { getAllCategories } from "../../category/store/category";
import { getAllUsers } from "./users";
import { getAllResponses } from "../../responses/store/response";

const user = ref<IUser>();

export const getUser = () => computed(() => user.value);
export const setUser = (info: IUser) => (user.value = info);
export const removeUserStore = () => user.value = new User();
export const getLoggedInUser = async () => {
    const {data} = await axios.get("/api/authenticate/getLoggedInUser");
    if(data == "noLogin")
    {
        if(router.currentRoute.value.name == "loginEdit")
        {
            return;
        }
        router.push({name: "login"});
    }
    else
    {
        loadAssets(data);
        user.value = data;

        // //only load in notes if user that is logging in is an admin
        // if(data.is_admin)
        // {
        // }
    }
};

export const loadAssets = async (user: User) => {
    await getAllTickets();
    await getAllStatuses();
    await getAllCategories();
    await getAllResponses();
    if(user.is_admin)
    {
        await getAllNotes();
        await getAllUsers();
    }
}