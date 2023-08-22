<script setup lang = "ts">
import BookForm from '../../components/book/BookForm.vue';
import { addBook } from '../../store/books';
import { router } from '../../router';
import { ref } from 'vue';
import { Book } from '../../types/book';

const submitBook = async (data: Book) => {
    await addBook(data);
    router.push({name: "home"});
}

const bookData = ref<Book>({
    id: NaN,
    name: "",
    author_id: NaN,
    image_path: "",
    created_at: "",
    updated_at: "",
    img: new File([], "")
});
</script>

<template>
    <BookForm :book = "bookData" @submit-form = "submitBook"/>
</template>