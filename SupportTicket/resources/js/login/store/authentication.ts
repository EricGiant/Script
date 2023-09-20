import axios from "../../api";
import { Login } from "../types/login";
import { router } from "../../router";

export const authenticateUser = async (formData: Login) => {
    const data = await axios.post("/api/authenticate/authenticateUser", {email: formData.email, password: formData.password}).catch((error) => error.response.status);
    return data;
}

export const logout = async () => {
    await axios.post("/api/authenticate/logout");
}

export const forgotPassword = async (email: string) => {
    await axios.post("/api/authenticate/sendResetPasswordEmail", {email: email});
    alert("AN EMAIL HAS BEEN SEND TO YOUR ACCOUNT");
}

//use interceptor to make catch errors and show them this is currently not implomented yet
export const updatePassword = async (password: string, token: string) => {
    await axios.patch("/api/authenticate/updatePassword", {password: password, token: token});
    alert("YOUR PASSWORD HAS BEEN CHANGED, U WILL NOW BE REDIRECTED TO THE LOGIN PAGE");
    router.push({name: "login"});
}