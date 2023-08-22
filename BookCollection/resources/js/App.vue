<script setup>
import Navbar from './views/navbar/Navbar.vue';
import { getAllAuthors } from './store/authors';
import { getAllBooks } from './store/books';
import { getAllReviews } from './store/reviews';

getAllBooks();
getAllAuthors();
getAllReviews();
</script>

<template>
    <Navbar />
    <router-view />
</template>