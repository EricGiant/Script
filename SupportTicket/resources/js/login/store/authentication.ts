import axios from "../../api";
import { getAllCategories } from "../../category/store/category";
import { getAllNotes, removeNoteStore } from "../../note/store/note";
import {
    getAllResponses,
    removeResponseStore,
} from "../../responses/store/response";
import { getAllStatuses } from "../../status/store/status";
import {
    getAllTickets,
    getTickets,
    removeTicketStore,
} from "../../ticket/store/ticket";
import { removeUserStore } from "../../user/store/user";
import { getAllUsers, removeUsersStore } from "../../user/store/users";
import { IUser } from "../../user/types/user";
import { Login } from "../types/login";

export const authenticateUser = async (formData: Login) => {
    const { data } = await axios.post("/api/authenticate/authenticateUser", {
        email: formData.email,
        password: formData.password,
    });
    return data;
};

export const logout = async () => {
    await axios.post("/api/authenticate/logout");
};

export const forgotPassword = async (email: string) => {
    await axios.post("/api/authenticate/sendResetPasswordEmail", {
        email: email,
    });
};

export const updatePassword = async (password: string, token: string) => {
    await axios.patch("/api/authenticate/updatePassword", {
        password: password,
        token: token,
    });
};

export const loadAssets = async (user: IUser) => {
    await getAllCategories();
    await getAllStatuses();
    await getAllTickets();
    await getAllResponses();
    await getAllUsers();
    if (user.is_admin) {
        await getAllNotes();
        await getAllUsers();
    }
};

export const unloadAssets = async () => {
    removeTicketStore();
    removeNoteStore();
    removeUsersStore();
    removeUserStore();
    removeResponseStore();
};
