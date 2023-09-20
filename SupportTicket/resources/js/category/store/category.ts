import { computed, ref } from "vue";
import { Category } from "../types/category";
import axios from "../../api";
import { getAllTickets } from "../../ticket/store/ticket";

const categories = ref<Category[]>();

export const getAllCategories = async () => {
    const {data} = await axios.get("/api/categories/index");
    if(!data) return
    categories.value = data;
}

export const getCategories = () => computed(() => categories.value);

export const getCategoryByID = (id: number) => computed(() => categories.value?.find((category) => category.id == id))

export const printCategoriesByID = (ids: Array<number>) => {
    let string = ""
    for(let i = 0; i < ids.length; i++)
    {
        string += getCategoryByID(ids[i]).value?.title;
        if(i + 1 != ids.length)
        {
            string += ", "
        }
    }
    return string;
}

export const deleteCategory = async (id: number) => {
    const {data} = await axios.delete("/api/categories/delete/" + id);
    if(!data) return
    categories.value = data;
    getAllTickets();
}

export const updateCategory = async (category: Category) => {
    const {data} = await axios.patch("/api/categories/update/" + category.id, {title: category.title});
    if(!data) return
    categories.value = data;
}

export const storeCategory = async (category: Category) => {
    const {data} = await axios.post("/api/categories/store", {title: category.title});
    if(!data) return
    categories.value = data;
}