import { ComputedRef, computed, ref } from "vue";
import axios from "axios";
import { Book } from "../types/book";

const books = ref<Book[]>([]); 

export const getAllBooks = async () => {
    const {data} = await axios.get("/api/getBooks");
    if(!data) return
    books.value = data;
}

export const getBooks = () => computed(() => books.value);

export const getBookById = (id: number): ComputedRef => computed(() => books.value.find((book) => book.id == id));

export const addBook = async (book: Book) => {
    let formData = new FormData();
    formData.append("img", book.img);
    formData.append("name", book.name);
    formData.append("author_id", book.author_id.toString());
    const {data} = await axios.post("/api/addBook", formData)
    if(!data) return
    books.value = data;
}

export const updateBook = async (book: Book) => {
    let formData = new FormData();
    if(book.img != undefined)
    {
        formData.append("img", book.img);
    }
    formData.append("name", book.name);
    formData.append("author_id", book.author_id.toString());
    formData.append("_method", "PATCH");
    const {data} = await axios.post("/api/updateBook/" + book.id, formData);

    if(!data) return
    books.value = data;
}

export const deleteBook = async (id: number) => {
    const {data} = await axios.delete("/api/deleteBook/" + id);
    if(!data) return
    books.value = data;
}