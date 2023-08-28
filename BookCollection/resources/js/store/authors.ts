import axios from "axios";
import { ComputedRef, computed, ref } from "vue";
import { Author } from "../types/author";
import { getAllBooks } from "./books";

const authors = ref<Author[]>([]);

// TODO: om duidelijk onderscheid tussen getters en actions te maken zou ik de
// actions zoals hier onder set<action name> noemen, dus setAuthors
export const getAllAuthors = async () => {
    const { data } = await axios.get("/api/getAuthors");
    if (!data) return;
    authors.value = data;
};

export const getAuthors = () => computed(() => authors.value);

export const getAuthorById = (id: number): ComputedRef =>
    computed(() => authors.value.find((author) => author.id == id));

export const addAuthor = async (author: Author) => {
    const { data } = await axios.post("/api/addAuthor", { name: author.name });
    if (!data) return;
    authors.value = data;
};

export const updateAuthor = async (author: Author) => {
    // TODO: gebruik evt. object destructuring in de functie parameter om id en name
    // als lokale variabelen beschikbaar te maken, levert leesbaardere code op
    const { data } = await axios.patch("/api/updateAuthor/" + author.id, {
        name: author.name,
    });
    if (!data) return;
    authors.value = data;
};

export const deleteAuthor = async (id: number) => {
    const { data } = await axios.delete("/api/deleteAuthor/" + id);
    if (!data) return;
    authors.value = data;
    getAllBooks(); // TODO: deze method zou ik vanuit de pagina aanroepen zodat
    // je store methods modulair blijven (minder dependencies)
};
