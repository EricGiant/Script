import { computed, ref } from "vue";
import { User } from "../types/user";
import axios from "../../api";

const users = ref<User[]>();

export const getAllUsers = async () => {
    const {data} = await axios.get("/api/users/index");
    if(!data) return
    users.value = data;
}

export const getUsers = () => computed(() => users.value);

export const getUserByID = (id: number) => computed(() => users.value?.find((user) => user.id == id));

export const getAdminUsers = () => computed(() => users.value?.filter((user) => user.is_admin == true));