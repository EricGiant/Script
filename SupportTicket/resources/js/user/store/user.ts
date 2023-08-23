import { computed, ref } from "vue";
import { User } from "../types/user";

const user = ref<User>();

export const getUser = () => computed(() => user.value);
export const setUser = (info: User) => user.value = info;
export const removeUserStore = () => user.value = {id: NaN, first_name: "", last_name: "", email: "", password: "", is_admin: false, telephone_number: "", created_at: "", updated_at: ""};