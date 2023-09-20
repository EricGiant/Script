import { computed, ref } from "vue";
import { User } from "../types/user";
import axios from "../../api";

const user = ref<User>();

export const getUser = () => computed(() => user.value);
export const setUser = (info: User) => user.value = info;
export const removeUserStore = () => user.value = {id: NaN, first_name: "", last_name: "", full_name: "", email: "", is_admin: false, telephone_number: "", created_at: "", updated_at: ""};
export const getLoggedInUser = async () => {
    const {data} = await axios.get("/api/authenticate/getLoggedInUser");
    if(!data) return
    user.value = data;
}