import axios from "axios";
import { computed, ref } from "vue";

const authors = ref<Author[]>([]);

interface Author {
    id: number,
    name: string,
    created_at: string,
    updated_at: string
}

export const getAllAuthors = async () => {
    const {data} = await axios.get("/api/getAuthors");
    if(!data) return
    authors.value = data;
}

export const getAuthors = () => computed(() => authors.value);

export const getAuthorById = (id: number) => authors.value.find((author) => author.id == id);

export const addAuthor = async (name: string) => {
    const {data} = await axios.post("/api/addAuthor", {name});
    if(!data) return
    authors.value = data
}