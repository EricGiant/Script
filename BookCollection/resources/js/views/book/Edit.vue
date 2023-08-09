<script setup lang = "ts">
import BookForm from '../../components/book/BookForm.vue';
import { getBookById, updateBook, deleteBook } from '../../store/books';
import { router } from '../../router';
import { ref } from 'vue';
import { Book } from '../../types/book';
import { useRoute } from 'vue-router';

//TO FIX
//on page relaod wait till stuff is loaded in before doing bookData stuff, otherwise book data wont load in

const submitBook = async () => {
    await updateBook(bookData.value);
    router.push("/");
}

const deleteBookFunc = async () => {
    await deleteBook(bookData.value.id);
    router.push("/");
}

const bookID: number = parseInt(useRoute().params.bookID[0]);
const bookData = ref<Book>({
    id: NaN,
    name: "",
    author_id: NaN,
    image_path: "",
    created_at: "",
    updated_at: "",
    img: new File([], "")
});
//@ts-ignore function can return nothing but fixing this would be dum and a wast of time
bookData.value = {...getBookById(bookID)};

</script>

<template>
    <BookForm :book-data = "bookData">
        <input type = "submit" value = "UPDATE" @click.prevent = "submitBook">
        <input type = "submit" value = "DELETE" @click.prevent = "deleteBookFunc">
    </BookForm>
</template>