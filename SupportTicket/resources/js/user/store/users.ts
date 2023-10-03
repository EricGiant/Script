import { computed, ref } from "vue";
import { IUser } from "../types/user";
import axios from "../../api";
import { getAllTickets } from "../../ticket/store/ticket";
import { getAllResponses } from "../../responses/store/response";
import { getUser } from "./user";
import { getAllNotes } from "../../note/store/note";

const users = ref<IUser[]>();

export const getAllUsers = async () => {
    const {data} = await axios.get("/api/users/index");
    if(!data) return
    users.value = data;
}

export const getUsers = () => computed(() => users.value);

export const getUserByID = (id: number) => computed(() => users.value?.find((user) => user.id == id));

export const getAdminUsers = () => computed(() => users.value?.filter((user) => user.is_admin == true));

export const getRollByBool = (is_admin: boolean) => {
    if(is_admin)
    {
        return "Admin User"
    }
    else
    {
        return "Normal User"
    }
};

export const updateUser = async (user: IUser) => {
    const {data} = await axios.patch("/api/users/update/" + user.id, {first_name: user.first_name, last_name: user.last_name, email: user.email, telephone_number: user.telephone_number, id: user.id});
    if(!data) return
    users.value = data;
}

export const deleteUser = async (id: number) => {
    const {data} = await axios.delete("/api/users/delete/" + id);
    if(!data) return
    else if(data == "ticketFound") return alert("THIS USER HAS NON AFGEHANDELDE TICKETS THEREFOR DELETION IS NOT POSSIBLE");
    users.value = data;
    await getAllTickets();
    await getAllResponses();
    if(getUser().value?.is_admin)
    {
        await getAllNotes();
    }
}

export const createUser = async (user: IUser) => {
    const {data} = await axios.post("/api/users/create", {first_name: user.first_name, last_name: user.last_name, password: user.password, email: user.email, telephone_number: user.telephone_number});
    if(!data) return
    users.value = data;
}