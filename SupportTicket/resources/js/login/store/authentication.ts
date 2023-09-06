import axios from "../../api";
import { login } from "../types/login";

export const authenticateUser = async (formData: login) => {
    const data = await axios
        .post("/api/authenticateUser", {
            email: formData.email,
            password: formData.password,
        })
        .catch((error) => error.response.status);
    return data;
};

export const logout = async () => {
    await axios.post("/api/logout");
};
