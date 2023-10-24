<script setup>
import Navbar from './views/navbar/Navbar.vue';
import { setAuthors } from './store/authors';
import { setBooks } from './store/books';
import { setReviews } from './store/reviews';

setBooks();
setAuthors();
setReviews();
</script>

<template>
    <Navbar />
    <router-view />
</template>