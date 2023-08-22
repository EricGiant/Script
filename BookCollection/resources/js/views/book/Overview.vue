<script setup lang = "ts">
import { getBooks } from "../../store/books";
import { getAuthorById } from "../../store/authors";

const books = getBooks();
</script>

<template>
    <div id = "contentBox" v-if = "books">
        <router-link :to = "{name: 'bookView', params: {bookID: book.id}}" v-for = "book in books">
            <p>{{ `${book.name} BY ${getAuthorById(book.author_id).value?.name}` }}</p>
            <img :src = "book['image_path']"><br>
            <router-link :to = "{name: 'bookEdit', params: {bookID: book.id}}">EDIT</router-link>
        </router-link>
    </div>
</template>

<style scoped>
#contentBox{
    text-align: center;
    width: 80%;
    margin: auto;
}
#contentBox img{
    max-width: 100%;
    max-height: 450px;
}
</style>