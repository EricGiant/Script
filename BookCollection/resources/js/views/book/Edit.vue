<script setup lang="ts">
import BookForm from "../../components/book/BookForm.vue";
import { getBookById, updateBook, deleteBook } from "../../store/books";
import { router } from "../../router";
import { useRoute } from "vue-router";
import { Book } from "../../types/book";

// TODO: gebruik camelCase, dus bookId ipv bookID
const bookData = getBookById(+useRoute().params.bookID);

const submitBook = async (data: Book) => {
    await updateBook(data);
    router.push({ name: "home" });
};

const deleteBookFunc = async () => {
    await deleteBook(bookData.value.id);
    router.push({ name: "home" });
};
</script>

<template>
    <BookForm :book="bookData" @submit-form="submitBook" v-if="bookData">
        <button @click.prevent="deleteBookFunc">DELETE</button>
    </BookForm>
</template>
