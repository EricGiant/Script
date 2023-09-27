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

//use interceptor to make catch errors and show them this is currently not implomented yet
export const updatePassword = async (password: string, token: string) => {
    await axios.patch("/api/authenticate/updatePassword", {password: password, token: token});
};
