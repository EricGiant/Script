import axios from "../../api";
import { Login } from "../types/login";

export const authenticateUser = async (formData: Login) => {
    const {data} = await axios.post("/api/authenticate/authenticateUser", {email: formData.email, password: formData.password});
    return data;
};

export const logout = async () => {
    await axios.post("/api/authenticate/logout");
};

export const forgotPassword = async (email: string) => {
    await axios.post("/api/authenticate/sendResetPasswordEmail", {email: email});
};

export const updatePassword = async (password: string, token: string) => {
    await axios.patch("/api/authenticate/updatePassword", {password: password, token: token});
};
