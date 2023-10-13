import { computed, ref } from "vue";
import { Category } from "../types/category";
import axios from "axios";

const categories = ref<Category[]>();

export const getAllCategories = async () => {
    const { data } = await axios.get("/api/getCategories");
    if (!data) return;
    categories.value = data;
};

export const getCategories = () => computed(() => categories.value);
