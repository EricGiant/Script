<script setup lang = "ts">
import { useRoute } from 'vue-router';
import { getBookById } from '../../store/books';
import { getAuthorById } from '../../store/authors';
import { ref } from 'vue';
import { getReviewsByBookId, addReview } from '../../store/reviews';
import ReviewForm from '../../components/review/ReviewForm.vue';
import { Review } from '../../types/review';

const bookID = +useRoute().params.bookID;
const reviews = getReviewsByBookId(bookID);
//empty review is used to trigger vue to trigger the reviewData to trigger the computed in the reviewForm so it will reset the textfield (same idea is used in bookform)
const emptyReview = <Review>{
    id: NaN,
    book_id: bookID,
    content: "",
    created_at: "",
    updated_at: ""
}
const reviewData = ref<Review>(Object.assign({}, emptyReview))
const book = getBookById(bookID);

const submitReview = async (data: Review) => {
    await addReview(data);
    //jeroen vind dit okay
    reviewData.value = Object.assign({}, emptyReview);

    //dit kan ook
    // reviewData.value.content = "TRIGGER UPDATE";
    // reviewData.value.content = "";
}
</script>

<template>
    <div id = "bookSection" v-if = "book">
        <p>{{ `${book.name} BY ${getAuthorById(book.author_id).value?.name}` }}</p>
        <img :src = "book.image_path">
    </div>
    <div id = "reviewSection">
        <ReviewForm :review = "reviewData" @submit-form = "submitReview"/>
        <div v-for = "review in reviews" v-if = "reviews">
            <p>{{ review.content }}</p>
            <router-link :to = "{name: 'reviewEdit', params: {reviewID: review.id}}">EDIT</router-link>
        </div>
    </div>
</template>

<style scoped>
#bookSection{
    text-align: center;
    width: 80%;
    margin: auto;
}
#bookSection img{
    max-width: 100%;
    max-height: 450px;
}
#reviewSection{
    text-align: center;
    width: 80%;
    margin: auto;
}
#reviewSection p{
    margin-bottom: 2px;
}
</style>