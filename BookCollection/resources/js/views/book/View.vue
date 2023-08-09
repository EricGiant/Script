<script setup>
import { useRoute } from 'vue-router';
import { getBookById } from '../../store/books';
import { getAuthorById } from '../../store/author';
import { getReviewsByBookId } from '../../store/reviews';

//THIS PAGE IS FCKING BROKEN RIGHT NOW DO NOT REVIEW, WILL BE OVERHAULING IT FULLY

//on page reload it loses store data IDK how to fix (to fix it on other pages I made the App.Vue load in everything but that doesn't fix it here)

const bookID = useRoute().params.bookID;
const book = getBookById(bookID);
const reviews = getReviewsByBookId(bookID);
</script>

<template>
    <div style = "text-align: center; width: 80%; margin: auto;">
        <p>{{ `${book.name} BY ${getAuthorById(book.author_id)}` }}</p>
        <img v-bind:src = "book['image_path']">
    </div>
    <div style = "text-align: center; width: 80%; margin: auto;">
        <div v-for = "review in reviews">
            <p style = "margin-bottom: 2px;">{{review.content}}</p>
            <router-link :to = "{ name: 'reviewEdit', params: {reviewID: review.id}}">EDIT</router-link>
        </div>
    </div>
</template>