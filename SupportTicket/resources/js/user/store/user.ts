import { computed, ref } from "vue";
import { IUser, User } from "../types/user";
import axios from "../../api";
import { router } from "../../router";
import { getAllNotes } from "../../note/store/note";

const user = ref<IUser>();

export const getUser = () => computed(() => user.value);
export const setUser = (info: IUser) => (user.value = info);
export const removeUserStore = () => user.value = new User();
export const getLoggedInUser = async () => {
    const {data} = await axios.get("/api/authenticate/getLoggedInUser");
    if(data == "noLogin")
    {
        router.push({name: "login"});
    }
    else
    {
        user.value = data;

        //only load in notes if user that is logging in is an admin
        if(data.is_admin)
        {
            await getAllNotes();
        }
    }
};
